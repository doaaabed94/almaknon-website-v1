<?php

namespace Modules\Member\Http\Controllers;

use DB;
use Auth;
use Hash;
use Validator;
use Exception;
use Bouncer;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Modules\Member\Entities\Country;
use Modules\Member\Entities\City;
use Modules\Member\Entities\Role;
use Modules\Member\Entities\Ability;
use Modules\Member\Entities\AbilityGroup;
use Modules\Member\Http\Responses\CrudResponse;
use Modules\Member\Http\Exceptions\PermissionsException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'user_locale'  => 'nullable',
            'password'     => 'required|min:8|confirmed',
            'country'      => 'nullable|exists:countries,id',
            'city'         => 'nullable|exists:cities,id',
            'email'        => 'required_without_all:phone_number|email|unique:users,email',
            'phone_number' => 'required_without_all:email|unique:users,phone_number',
            'address'      => 'nullable|max:2500',
            'username'     => 'nullable|unique:users,username',
            'roles'        => 'required|exists:roles,name',
            'status'       => 'required|in:ACTIVE,DISABLED',
            'gender'       => 'nullable|in:M,F,U',
            'birthday'     => 'nullable|date_format:Y-m-d',
        ],
        'postUpdate' => [
            'first_name'       => 'required',
            'last_name'        => 'required',
            'user_locale'      => 'nullable',
            // 'current_password' => 'required_with:password',
            'password'         => 'nullable|min:8|confirmed',
            'country'          => 'nullable|exists:countries,id',
            'city'             => 'nullable|exists:cities,id',
            'email'            => 'required_without_all:phone_number|email|unique:users,email',
            'phone_number'     => 'required_without_all:email|unique:users,phone_number',
            'address'          => 'nullable|max:2500',
            'username'         => 'nullable|unique:users,username',
            'roles'            => 'nullable|exists:roles,name',
            'status'           => 'required|in:ACTIVE,DISABLED',
            'gender'           => 'nullable|in:M,F,U',
            'birthday'         => 'nullable|date_format:Y-m-d',
        ],
        'loginAs' => [
            // 'current_password' => 'required|min:8',
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('NeedPermissions:READ_USERS')->only(['index', 'postIndex', 'read']);
        $this->middleware('NeedPermissions:READ_USERS')->only(['postIndex', 'read']);
        $this->middleware('NeedPermissions:CREATE_USERS')->only(['create', 'postCreate']);
        $this->middleware('NeedPermissions:UPDATE_USERS')->only(['update', 'postUpdate']);
        $this->middleware('NeedPermissions:DELETE_USERS')->only(['postDelete']);
        $this->middleware('NeedPermissions:RESTORE_USERS')->only(['postRestore']);
        $this->middleware('NeedPermissions:PERMA_DELETE_USERS')->only(['postPermaDelete']);
        $this->middleware('NeedPermissions:STATUS_UPDATE_USERS')->only(['postStatus']);
        $this->middleware('NeedPermissions:LOGIN_AS_USERS')->only(['loginAs']);
    }

    public function index(Request $request)
    {   
         if (auth()->user()->can('READ_USERS')) {
        $this->data['Countries'] = Country::with('translations')->get();
        $this->data['Roles']     = Role::with('translations')->get();
        $this->data['Users'] = User::select([
            '*',
            DB::raw('
                DATE_FORMAT(created_at, "%Y-%m-%d") AS new_created_at,
                DATE_FORMAT(updated_at, "%Y-%m-%d") AS new_updated_at
            '),
            DB::raw('(CASE 
                WHEN status = "ACTIVE"   THEN "'. __('member::strings.active') .'"
                WHEN status = "DISABLED" THEN "'. __('member::strings.disabled') .'"
                ELSE "-----"
            END) AS new_status')
        ])
        ->with('Roles');
        
            $this->data['Users']->withTrashed();
            $this->data['Users']->withDisabled();

        $this->data['Users'] = $this->data['Users']->get();
        return view('member::users.index', $this->data);

    }else{
        return view('member::index');
    }
    }

    public function create(Request $request)
    {
        $this->data['CurrentUser'] = $request->user();
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['Countries']   = Country::with('translations')->get();

        if ($this->data['CurrentUser']->isAn('ROOT')) {
            $this->data['Roles'] = Role::with('translations')->get();
        }
        else if($this->data['CurrentUser']->isAn('SYSTEM_ADMIN')) {
            $this->data['Roles'] = Role::with('translations')->where('name', '!=', 'ROOT')->get();
        }
        else {
            $this->data['Roles'] = Role::with('translations')->whereNotIn('name', ['ROOT', 'SYSTEM_ADMIN'])->get();
        }
        return view('member::users.add', $this->data);
    }

    public function postCreate(Request $request)
    {
        $this->data['CurrentUser'] = $request->user();
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postCreate']
        );
        $this->data['_VALIDATOR_']->after(function ($validator)use($request){
            if ($request->roles == 'ROOT' && !$this->data['CurrentUser']->isAn('ROOT')) {
                $validator->errors()->add('roles', __('member::strings.this_permissions_is_cant_assigned_by_your_account'));
            }
            if ($request->roles == 'SYSTEM_ADMIN' && (!$this->data['CurrentUser']->isAn('SYSTEM_ADMIN', 'ROOT')) ) {
                $validator->errors()->add('roles', __('member::strings.this_permissions_is_cant_assigned_by_your_account'));
            }
        });

        $this->data['_VALIDATOR_']->validate();

        try {
            $this->data['model'] = new User;
            DB::transaction(function()use($request){
                $this->data['model']->first_name   = $request->first_name;
                $this->data['model']->last_name    = $request->last_name;
                $this->data['model']->locale       = empty($request->user_locale) ? app()->getLocale() : $request->user_locale;
                $this->data['model']->country_id   = empty($request->country) ? null : $request->country;
                $this->data['model']->city_id      = empty($request->city)    ? null : $request->city;
                $this->data['model']->email        = $request->email;
                $this->data['model']->username     = $request->username;
                $this->data['model']->phone_number = $request->phone_number;
                $this->data['model']->type = $request->roles;
                $this->data['model']->address      = empty($request->address) ? null : $request->address;
                $this->data['model']->password     = Hash::make( $request->password );
                $this->data['model']->gender       = empty($request->gender) ? 'M' : $request->gender;
                $this->data['model']->birthday     = empty($request->birthday) ? null : Carbon::parse($request->birthday)->toDateTimeString();
                $this->data['model']->status       = 'DISABLED';
                if ($this->data['CurrentUser']->can('STATUS_UPDATE_USERS') OR $this->data['CurrentUser']->isAn('ROOT')) {
                    $this->data['model']->status = $request->status;
                }
                if(!empty($request->email) && empty($request->send_confirmation_by_email)){
                    $this->data['model']->email_verified_at = Carbon::now()->toDateTimeString();
                }
                else if(!empty($request->email) && !empty($request->send_confirmation_by_email)){
                    //Send Verification Email
                    try {

                    } 
                    catch(Exception $e) {
                        
                    }
                }
                if(!empty($request->phone_number) && empty($request->send_confirmation_by_email)){
                    $this->data['model']->phone_number_verified_at = Carbon::now()->toDateTimeString();
                }
                else if(!empty($request->phone_number) && !empty($request->send_confirmation_by_sms)){
                    //Send Verification SMS
                    try {

                    } 
                    catch(Exception $e) {
                        
                    }
                }
                $this->data['model']->save();
                if ($request->hasFile('avatar')) {
                    // app()->make('GraphManager')->remove( $this->data['model']->avatar );
                    $this->data['AVATAR'] = $request->file('avatar')->store('user', 'graph');
                    $this->data['model']->avatar = $this->data['AVATAR'];
                }
                $this->data['model']->save();
                    Bouncer::assign( $request->roles )->to( $this->data['model'] );
                    $this->data['model']->type = $request->roles;
                    $this->data['model']->save();
            });
        } 
        catch(PermissionsException $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.permissions_error.title'),
                'message_description' => __('member::strings.permissions_error.description'),
                'errors'              => []
            ], 500);
        }
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => [],
            'redirect_url'        => route('member::users.index'),
        ], 200);
    }

    public function update(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['model']       = User::with('roles')->findOrFail( $request->model );
        $this->data['CurrentUser'] = $request->user();
        $this->data['Countries']   = Country::with('translations')->get();
        if ($this->data['CurrentUser']->isAn('ROOT')) {
            $this->data['Roles'] = Role::with('translations')->get();
        }
        else if($this->data['CurrentUser']->isAn('SYSTEM_ADMIN')) {
            $this->data['Roles'] = Role::with('translations')->where('name', '!=', 'ROOT')->get();
        }
        else {
            $this->data['Roles'] = Role::with('translations')->whereNotIn('name', ['ROOT', 'SYSTEM_ADMIN'])->get();
        }
        $this->data['model']->setRelation(
            'City', City::with('translations', 'Country.translations')->find($this->data['model']->city_id)
        );
        return view('member::users.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->data['model'] = User::findOrFail($request->model);
        } catch(Exception $e) {
            return redirect()->route('member::errors.404', $this->data);
        }

        static::$validationsRules['postUpdate']['email']        = static::$validationsRules['postUpdate']['email']        . ',' . $this->data['model']->id;
        static::$validationsRules['postUpdate']['username']     = static::$validationsRules['postUpdate']['username']     . ',' . $this->data['model']->id;
        static::$validationsRules['postUpdate']['phone_number'] = static::$validationsRules['postUpdate']['phone_number'] . ',' . $this->data['model']->id;

        $this->data['CurrentUser'] = $request->user();
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), static::$validationsRules['postUpdate']
        );

        $this->data['_VALIDATOR_']->after(function ($validator)use($request) {
            if (!empty($request->password)) {
                // if (!$this->data['CurrentUser']->isAn('ROOT', 'SYSTEM_ADMIN')) {
                //     if (! Hash::check($request->current_password, $this->data['CurrentUser']->password)) {
                //         $validator->errors()->add(
                //             'current_password', __('member::strings.current_password_is_incorrect')
                //         );
                //     }
                // } 
                // else {
                //     if (! Hash::check($request->current_password, $this->data['model']->password)) {
                //         $validator->errors()->add(
                //             'current_password', __('member::strings.current_password_is_incorrect')
                //         );
                //     }
                // }
            }
            if ($request->roles == 'ROOT' && !$this->data['CurrentUser']->isAn('ROOT')) {
                $validator->errors()->add(
                    'roles', __('member::strings.this_permissions_is_cant_assigned_by_your_account')
                );
            }
            if ($request->roles == 'SYSTEM_ADMIN' && (!$this->data['CurrentUser']->isAn('SYSTEM_ADMIN', 'ROOT')) ) {
                $validator->errors()->add(
                    'roles', __('member::strings.this_permissions_is_cant_assigned_by_your_account')
                );
            }
        });

        $this->data['_VALIDATOR_']->validate();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->first_name   = $request->first_name;
                $this->data['model']->last_name    = $request->last_name;
                $this->data['model']->locale       = empty($request->user_locale) ? app()->getLocale() : $request->user_locale;
                $this->data['model']->country_id   = empty($request->country) ? null : $request->country;
                $this->data['model']->city_id      = empty($request->city)    ? null : $request->city;
                $this->data['model']->email        = $request->email;
                $this->data['model']->username     = $request->username;
                $this->data['model']->phone_number = $request->phone_number;
                $this->data['model']->type = $request->roles;
                $this->data['model']->address      = empty($request->address) ? null : $request->address;
                $this->data['model']->gender       = empty($request->gender) ? 'M' : $request->gender;
                $this->data['model']->birthday     = empty($request->birthday) ? null : Carbon::parse($request->birthday)->toDateTimeString();
                if (!empty($request->password)) {
                    $this->data['model']->password = Hash::make( $request->password );
                }
                if ($this->data['CurrentUser']->can('STATUS_UPDATE_USERS') OR $this->data['CurrentUser']->isAn('ROOT')) {
                    if (!empty($request->status)) {
                        $this->data['model']->status = $request->status;
                    }
                }
                $this->data['model']->save();
                if ($request->hasFile('avatar')) {
                    app()->make('GraphManager')->remove( $this->data['model']->avatar );
                    $this->data['AVATAR'] = $request->file('avatar')->store('user', 'graph');
                    $this->data['model']->avatar = $this->data['AVATAR'];
                }
                $this->data['model']->save();
                if ($this->data['CurrentUser']->can('PERMISSIONS_UPDATE_USERS') OR $this->data['CurrentUser']->isAn('ROOT')) {
                    Bouncer::sync( $this->data['model'] )->roles([$request->roles]);
                    $this->data['model']->type = $request->roles;
                    $this->data['model']->save();
                }
            });
        }
        catch(PermissionsException $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.permissions_error.title'),
                'message_description' => __('member::strings.permissions_error.description'),
                'errors'              => [],
            ], 500);
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => [],
            'redirect_url'        => route('member::users.update', ['model' => $this->data['model']->id]),
        ], 200);
    }

    public function postDelete(Request $request)
    {
        try {
            $this->data['model']       = User::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_USERS') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->deleted_by = $request->user()->id;
                $this->data['model']->save();
                $this->data['model']->delete();
            });
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.delete_success.title'),
            'message_description' => __('member::strings.delete_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postRestore(Request $request)
    {
        try {
            $this->data['model'] = User::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_USERS') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_USERS') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->restore();
            });
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.restore_success.title'),
            'message_description' => __('member::strings.restore_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postPermaDelete(Request $request)
    {
        try {
            $this->data['model']       = User::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_USERS') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_USERS') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->forceDelete();
            });
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.perma_delete_success.title'),
            'message_description' => __('member::strings.perma_delete_success.description'),
            'errors'              => []
        ], 200);
    }

    public function postStatus(Request $request)
    {
        try {
            $this->data['model']       = User::query();
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('RESTORE_USERS') ) {
                $this->data['model']->withTrashed();
            }
            if ( auth()->user()->isAn('ROOT') OR auth()->user()->can('STATUS_UPDATE_USERS') ) {
                $this->data['model']->withDisabled();
            }
            $this->data['model'] = $this->data['model']->findOrFail( $request->model );
        } 
        catch(Exception $e) {
            // return redirect()->route('member::errors.404', $this->data);
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 404);
        }
        $this->data['CurrentUser'] = $request->user();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->updated_by = $request->user()->id;
                if ($this->data['model']->isDisabled()) {
                    $this->data['model']->status = 'ACTIVE';
                    $this->data['model']->save();
                    $this->data['model']->enable();
                }
                else if ($this->data['model']->isEnabled()) {
                    $this->data['model']->status = 'DISABLED';
                    $this->data['model']->save();
                    $this->data['model']->disable();
                }
            });
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.save_success.title'),
            'message_description' => __('member::strings.save_success.description'),
            'errors'              => []
        ], 200);
    }

    public function read(Request $request)
    {
        $this->data['locale'] = $request->locale ? $request->locale : app()->getLocale();
        $this->data['model']  = User::findOrFail( $request->model );
        $this->data['model']->setRelation(
            'City', City::with('translations', 'Country.translations')->find($this->data['model']->city_id)
        );
        return view('member::users.read', $this->data);
    }

    public function loginAs(Request $request)
    {
        try {
            $this->data['model']     = User::findOrFail($request->model);
            $this->data['JWT_TOKEN'] = JWTAuth::fromUser(auth()->user());
            session([
                'OLD_USER_JWT_TOKEN' => $this->data['JWT_TOKEN']
            ]);
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        $this->data['CurrentUser'] = $request->user();

        try {
            Auth::logout();
            Auth::login($this->data['model']);
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.success'),
            'message_description' => __('member::strings.you_have_logged_in_to_new_account'),
            'errors'              => [],
            'redirect_url'        => route('member::index'),
        ], 200);
    }

    public function loginAsFromToken(Request $request)
    {
        try {
            if (empty(session()->get('OLD_USER_JWT_TOKEN'))) {
                return new CrudResponse([
                    'success'             => false,
                    'type'                => 'toastr',
                    'message_type'        => 'error',
                    'message_title'       => __('member::strings.error.title'),
                    'message_description' => __('member::strings.error.description'),
                    'errors'              => []
                ], 500);
            }
            $this->data['PAYLOAD']  = JWTAuth::setToken(session()->get('OLD_USER_JWT_TOKEN'))->getPayload()->toArray();
            $this->data['OLD_USER'] = JWTAuth::toUser( session()->get('OLD_USER_JWT_TOKEN') );
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                // 'message_description' => __('member::strings.error.description'),
                'message_description' => $e->getMessage(),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        $this->data['CurrentUser'] = $request->user();

        try {
            $request->session()->forget(['OLD_USER_JWT_TOKEN']);
            Auth::logout();
            Auth::login( $this->data['OLD_USER'] );
        } 
        catch(Exception $e) {
            return new CrudResponse([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => __('member::strings.error.description'),
                'errors'              => [
                    'exception' => [
                        'message' => $e->getMessage(),
                        'code'    => $e->getCode(),
                        'line'    => $e->getLine(),
                        'file'    => $e->getFile(),
                    ],
                ]
            ], 500);
        }

        return new CrudResponse([
            'success'             => true,
            'type'                => 'toastr',
            'message_type'        => 'success',
            'message_title'       => __('member::strings.success'),
            'message_description' => __('member::strings.back_to_old_logged_in_account_done'),
            'errors'              => [],
            'redirect_url'        => route('member::index'),
        ], 200);
    }
}
