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

class ProfileController extends AdminBaseController
{
    public static $validationsRules = [
        'postCreate' => [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'user_locale'  => 'required',
            'password'     => 'nullable|min:8|confirmed',
            'country'      => 'nullable|exists:countries,id',
            'city'         => 'nullable|exists:cities,id',
            'email'        => 'required_without_all:phone_number|email|unique:users,email',
            'phone_number' => 'required_without_all:email|unique:users,phone_number',
            'address'      => 'nullable|max:2500',
            'username'     => 'nullable|unique:users,username',
            'gender'       => 'nullable|in:M,F,U',
            'birthday'     => 'nullable|date_format:Y-m-d',
        ],
        'postUpdate' => [
            'first_name'       => 'required',
            'last_name'        => 'required',
            'user_locale'      => 'required',
            'current_password' => 'required_with:password',
            'password'         => 'nullable|min:8|confirmed',
            'country'          => 'nullable|exists:countries,id',
            'city'             => 'nullable|exists:cities,id',
            'email'            => 'required_without_all:phone_number|email|unique:users,email',
            'phone_number'     => 'required_without_all:email|unique:users,phone_number',
            'address'      => 'nullable|max:2500',
            'username'         => 'nullable|unique:users,username',
            'gender'           => 'nullable|in:M,F,U',
            'birthday'         => 'nullable|date_format:Y-m-d',
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['model']       = User::with('roles')->findOrFail( auth()->user()->id );
        $this->data['CurrentUser'] = $request->user();
        $this->data['Countries']   = Country::with('translations')->get();
        $this->data['model']->setRelation(
            'City', City::with('translations', 'Country.translations')->find($this->data['model']->city_id)
        );
        return view('member::profile.update', $this->data);
    }

    public function postUpdate(Request $request)
    {
        try {
            $this->data['model'] = User::findOrFail(auth()->user()->id);
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
                if (!$this->data['CurrentUser']->isAn('ROOT', 'SYSTEM_ADMIN')) {
                    if (! Hash::check($request->current_password, $this->data['CurrentUser']->password)) {
                        $validator->errors()->add(
                            'current_password', __('member::strings.current_password_is_incorrect')
                        );
                    }
                } 
                else {
                    if (! Hash::check($request->current_password, $this->data['model']->password)) {
                        $validator->errors()->add(
                            'current_password', __('member::strings.current_password_is_incorrect')
                        );
                    }
                }
            }
        });

        $this->data['_VALIDATOR_']->validate();

        try {
            DB::transaction(function()use($request){
                $this->data['model']->first_name   = $request->first_name;
                $this->data['model']->last_name    = $request->last_name;
                $this->data['model']->locale       = $request->user_locale;
                $this->data['model']->country_id   = $request->country;
                $this->data['model']->city_id      = $request->city;
                $this->data['model']->email        = $request->email;
                $this->data['model']->username     = $request->username;
                $this->data['model']->phone_number = $request->phone_number;
                $this->data['model']->address      = empty($request->address) ? null : $request->address;
                $this->data['model']->gender       = $request->gender;
                $this->data['model']->birthday     = empty($request->birthday) ? null : Carbon::parse($request->birthday)->toDateTimeString();
                if (!empty($request->password)) {
                    $this->data['model']->password = Hash::make( $request->password );
                }
                $this->data['model']->save();
                if ($request->hasFile('avatar')) {
                    app()->make('GraphManager')->remove( $this->data['model']->avatar );
                    $this->data['AVATAR'] = $request->file('avatar')->store('user', 'graph');
                    $this->data['model']->avatar = $this->data['AVATAR'];
                }
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
                            'redirect_to'         => route('member::ProfileController@update'),
        ], 200);
    }
}
