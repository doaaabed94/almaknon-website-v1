<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Maknon\Entities\Member;

class MemberController extends Controller
{
  
    public $validations = [];

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [
                'postLogout', 
            ]
        ]);

        $this->middleware('guest', [
            'except' => ['postLogout']
        ]);

        $this->validations = [
            'login' => [
                'email' => 'required',
                'password'             => 'required|min:8',
            ],
            'register' => [
                'full_name'                 => 'required|max:191',
                'email'                      => 'required|email|unique:mk_member,email',
                'password'                   => 'required|min:8|confirmed',
                'password_confirmation'      => 'required|min:8',
                'terms_and_usage_acceptance' => 'required'
            ],
            'postResetRequest' => [
                'email' => 'required'
            ],
        ];
    }

    public function login(Request $request)
    {
        return view('frontend::member.login', $this->data);
    }

    
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validations['login']);
        $validator->validate();

        $this->data['user'] = Member::where(function($User)use($request){
            $User->where('email', $request->email);
        });

        try {
            $this->data['user'] = $this->data['user']->first();
        } 
        catch (\Exception $e) {
            if( $request->ajax() ){
                $toReturn['success']             = false;
                $toReturn['message_type']        = 'error';
                $toReturn['message_title']       = __('member::strings.error');
                $toReturn['message_description'] = __('member::auth.user_not_found') .', ' . __('member::auth.make_sure_you_entered_the_correct_details');
                $toReturn['errors']              = [];
                return response()->json($toReturn, 403);
            }
            return redirect()->back()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error'),
                'message_description' =>"cATCH",
                'errors'              => [],
            ])->withInput();
        }

        if(is_null($this->data['user'])){
            return new CrudResponse([
                'success'             => false,
                'type'                => 'swal',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error.title'),
                'message_description' => "no user",
                'errors'              => []
            ], 500);
        }

        if (! Hash::check($request->password, $this->data['user']->password)) {
            
            $validator->after(function ($validator) {
                $validator->errors()->add('password', __('member::auth.wrong_password'));
            });

            if ( $validator->fails() ){
                if( $request->ajax() ){
                    $toReturn['success']             = false;
                    $toReturn['message_type']        = 'error';
                    $toReturn['message_title']       = null;
                    $toReturn['message_description'] = null;
                    $toReturn['errors']              = [];
                    $messages = $validator->messages()->toArray();
                    foreach ($messages as $key => $value) {
                        $toReturn['errors'][ $key ] = $value;
                    }
                    return response()->json($toReturn, 422);
                }
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }        

        if ($this->data['user']->status != 'ACTIVE') {
            if( $request->ajax() ){
                $toReturn['success']             = false;
                $toReturn['message_type']        = 'error';
                $toReturn['message_title']       = __('member::strings.error');
                $toReturn['message_description'] = __('member::auth.user_is_not_active');
                $toReturn['errors']              = [];
                return response()->json($toReturn, 403);
            }
            return redirect()->back()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error'),
                'message_description' => __('member::auth.user_is_not_active'),
                'errors'              => [],
            ])->withInput();
        }

        $Remember = !is_null($request->remember_me) ? true : false;

        Auth::loginUsingId($this->data['user']->id, $Remember);


        if ($request->ajax()) {
            $url = redirect()->intended( route('member::index') )->getTargetUrl();
            $toReturn['success']             = true;
            $toReturn['message_type']        = 'success';
            $toReturn['message_title']       = null;
            $toReturn['message_description'] = null;
            $toReturn['errors']              = [];
            $toReturn['redirect_to']         = $url;
            return response()->json($toReturn, 200);
        }

        return redirect()->intended( route('frontend::profile') );
    }

    public function register(Request $request)
    {
        return view('member::auth.register', $this->data);
    }

    public function postRegister(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), $this->validations['register']
        );
        $this->data['_VALIDATOR_']->validate();

        try {
            if (! config('admin.auth.registration.active')) {
                throw new PermissionsException("Registration Not Allowed", 403);
            }

            $this->data['model'] = new User;
            DB::transaction(function() use($request) {
                $this->data['model']->full_name        = $request->full_name;
                $this->data['model']->email         = $request->email;
                $this->data['model']->phone_number             = $request->phone_number;
                $this->data['model']->password          = Hash::make($request->password);
                $this->data['model']->locale            = $this->data['locale'];
                $this->data['model']->email_verified_at = Carbon::now()->toDateTimeString();
                $this->data['model']->save();
                Auth::login($this->data['model']);
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
            'success'                => true,
            'type'                   => 'toastr',
            'message_type'           => 'success',
            'message_title'          => __('member::strings.save_success.title'),
            'message_description'    => __('member::strings.save_success.description'),
            'errors'                 => [],
        ], 200);
    }

        public function changePassword(Request $request)
    {
        return view('member::auth.changePassword', $this->data);
    }

    public function postChangePassword(Request $request)
    {
    }

    public function postLogout(Request $request)
    {
        try {
            Auth::logout();
        } catch (Exception $e) {
            if( $request->ajax() ){
                $toReturn['success']             = false;
                $toReturn['message_type']        = 'error';
                $toReturn['message_title']       = __('member::strings.error');
                $toReturn['message_description'] = __('member::strings.unkown_error_ocurred');
                $toReturn['errors']              = [];
                return response()->json($toReturn, 403);
            }
            return redirect()->back()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error'),
                'message_description' => __('member::strings.unkown_error_ocurred'),
                'errors'              => [],
            ]);
        }

        if ($request->ajax()) {
            $url = redirect()->intended( route('login') )->getTargetUrl();
            $toReturn['success']             = true;
            $toReturn['message_type']        = 'success';
            $toReturn['message_title']       = null;
            $toReturn['message_description'] = null;
            $toReturn['errors']              = [];
            $toReturn['redirect_to']         = $url;
            return response()->json($toReturn, 200);
        }
        return redirect()->intended( route('login') );
    }

        public function profile(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }

        public function postProfile(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }



        public function addEvaluation(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }

        public function removeEvaluation(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }



        public function addFavorite(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }

        public function removeFavorite(Request $request)
    {
        return view('frontend::member.profile', $this->data);
    }
    

}
