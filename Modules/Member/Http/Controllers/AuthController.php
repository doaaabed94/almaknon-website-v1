<?php

namespace Modules\Member\Http\Controllers;

// use JWTAuth;
use DB;
use Validator;
use Hash;
use Exception;
use Mail;
use Bouncer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Member\Http\Responses\CrudResponse;
use Modules\Member\Http\Exceptions\PermissionsException;

class AuthController extends AdminBaseController
{
    public $validations = [];

    public function __construct()
    {
        $this->middleware('auth', [
            'only' => [
                'postLogout', 
                // 'twoFactorUnlock', 
                // 'postTwoFactorUnlock',
                // 'sendTwoFactorUnlock'
            ]
        ]);

        $this->middleware('guest', [
            'except' => ['postLogout', 'getLoginByJwtToken']
        ]);

        $this->validations = [
            'login' => [
                'email_username_phone' => 'required',
                'password'             => 'required|min:8',
            ],
            'register' => [
                'first_name'                 => 'required|max:191',
                'last_name'                  => 'required|max:191',
                'email'                      => 'required|email|unique:users,email',
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
        return view('member::auth.login', $this->data);
    }

    
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validations['login']);
        $validator->validate();

        $this->data['user'] = User::where(function($User)use($request){
            $User->where('email', $request->email_username_phone);
            $User->orWhere('phone_number', $request->email_username_phone);
            $User->orWhere('username', $request->email_username_phone);
        });

        try {
            // \Event::fire('AuthController@postLogin[User::query]', [$request, $this->data['user']]);
            $this->data['user'] = $this->data['user']->first();
            if ( $this->data['user'] ) {
              //   \Event::fire('AuthController@postLogin[User::fetched]', [$request, $this->data['user']]);
            }
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

        if (is_null($this->data['user']->email_verified_at)) {
            if( $request->ajax() ){
                $toReturn['success']             = false;
                $toReturn['message_type']        = 'error';
                $toReturn['message_title']       = __('member::strings.error');
                $toReturn['message_description'] = __('member::auth.user_email_is_not_active');
                $toReturn['errors']              = [];
                return response()->json($toReturn, 403);
            }
            return redirect()->back()->with('result', [
                'success'             => false,
                'message_type'        => 'error',
                'message_title'       => __('member::strings.error'),
                'message_description' => __('member::auth.user_email_is_not_active'),
                'errors'              => [],
            ])->withInput();
        }

        $Remember = !is_null($request->remember_me) ? true : false;

        Auth::loginUsingId($this->data['user']->id, $Remember);
        
        // if ( config('admin.two_factor_login.active') ) {
        //     $this->sendTwoFactorUnlock( $request , $this->data['user'] );
        // }

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

        return redirect()->intended( route('member::index') );
    }

    public function getLoginByJwtToken(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if( ! $user ) {
                throw new Exception('User Not Found');
            }
            Auth::logout();
            Auth::login($user);
        } 
        catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    'message' => 'fail',
                    'data'    => [
                        'result' => '',
                    ],
                    'errors'  => [
                        'global' => 'token_invalid',
                    ]
                ]);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'message' => 'fail',
                    'data'    => [
                        'result' => '',
                    ],
                    'errors'  => [
                        'global' => 'token_expired',
                    ]
                ]);
            }
            else {
                if( $e->getMessage() === 'User Not Found') {
                    return response()->json([
                        'message' => 'fail',
                        'data'    => [
                            'result' => '',
                        ],
                        'errors'  => [
                            'global' => 'user_not_found',
                        ]
                    ]);
                }
                return response()->json([
                    'message' => 'fail',
                    'data'    => [
                        'result' => '',
                    ],
                    'errors'  => [
                        'global' => 'token_is_required',
                    ]
                ]);
            }
        }
        return response()->json([
            'message' => 'success',
            'data'    => [
                'result' => 'session_created',
            ],
            'errors'  => [
                'global' => '',
            ]
        ]);
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
                $this->data['model']->first_name        = $request->first_name;
                $this->data['model']->last_name         = $request->last_name;
                $this->data['model']->email             = $request->email;
                $this->data['model']->username          = null;
                $this->data['model']->password          = Hash::make($request->password);
                $this->data['model']->locale            = $this->data['locale'];
                $this->data['model']->email_verified_at = Carbon::now()->toDateTimeString();
                $this->data['model']->type              = config('admin.auth.registration.role');
                $this->data['model']->save();
                Bouncer::assign(config('admin.auth.registration.role'))->to($this->data['model']);
             //    \Event::fire('AuthController@postRegister[CREATED]', [$request, $this->data['model']]);
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

    public function verifyRequest(Request $request)
    {
        return view('member::auth.verifyRequest', $this->data);
    }

    public function postVerifyRequest(Request $request)
    {
    }

    public function resetRequest(Request $request)
    {
        return view('member::auth.resetRequest', $this->data);
    }

    public function postResetRequest(Request $request)
    {
        $this->data['locale']      = $request->locale ? $request->locale : app()->getLocale();
        $this->data['_VALIDATOR_'] = Validator::make(
            $request->all(), $this->validations['postResetRequest']
        );
        $this->data['_VALIDATOR_']->validate();

        try {
            DB::transaction(function() use($request) {
                
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
            'message_title'          => __('member::strings.reset_code_sent.title'),
            'message_description'    => __('member::strings.reset_code_sent.description'),
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
            if (!empty(session()->get('OLD_USER_JWT_TOKEN'))) {
                $request->session()->forget(['OLD_USER_JWT_TOKEN']);
            }
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

    // public function twoFactorUnlock(Request $request)
    // {        
    //     if (empty(auth()->user()->login_code)) {
    //         return redirect()->route('member::index');
    //     }

    //     if ( config('admin.two_factor_login.active') ) {
    //         return view('member::auth.two_factor_login', $this->data);
    //     }

    //     auth()->user()->login_code = null;
    //     auth()->user()->save();
    //     return redirect()->route('member::index');
    // }

    // public function postTwoFactorUnlock(Request $request)
    // {
    //     if (auth()->user()->login_code != $request->login_code) {
    //         return new CrudResponse([
    //             'success'             => false,
    //             'type'                => 'toastr',
    //             'message_type'        => 'error',
    //             'message_title'       => __('member::strings.error.title'),
    //             'message_description' => __('member::strings.wrong_code'),
    //             'errors'              => [],
    //             'redirect_url'        => route('AuthController@twoFactorUnlock'),
    //         ], 500);
    //     }
    //     auth()->user()->login_code = null;
    //     auth()->user()->save();
    //     return redirect()->intended( route('member::index') );
    // }

    // public function sendTwoFactorUnlock(Request $request, $User = null)
    // {
    //     try {
    //         $User = empty( $User ) ? auth()->user() : $User;
    //         if ($User->isAn('ROOT') OR $User->isAn('SYSTEM_ADMIN')) {
    //             return true;
    //         }
    //         $User->login_code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
    //         $User->save();

    //         if (empty($User->email)) {
    //             return new CrudResponse([
    //                 'success'             => true,
    //                 'type'                => 'toastr',
    //                 'message_type'        => 'success',
    //                 'message_title'       => __('member::strings.save_success.title'),
    //                 'message_description' => __('member::strings.save_success.description'),
    //                 'errors'              => [],
    //             ], 200);
    //         }

    //         $SenderName = \Modules\Member\Entities\Config::of('system_name', \Modules\Member\Entities\Config::of('system_developer_name', __( config('app.name') )));

    //         $data = [
    //             'access_code' => $User->login_code,
    //             'access_link' => route('AuthController@twoFactorUnlock', ['access_code' => $User->login_code]),
    //         ];
    //         Mail::send('member::email_templates.two_factor_login', $data, function ($message) use( $User, $SenderName, $request ) {
    //             /* "Required" (It's self explaining ;)) */
    //             $message->to($User->email, $User->first_name . ' ' . $User->last_name);
                
    //             /* Optional */
    //             $message->from('no-reply@' . $request->getHost(), $SenderName);
    //             $message->sender('no-reply@' . $request->getHost(), $SenderName);
    //             $message->subject('Auto Login Code ' . date('Y-m-d H:i'));
    //         });
    //     } 
    //     catch (Exception $e) {
    //         return new CrudResponse([
    //             'success'             => false,
    //             'type'                => 'toastr',
    //             'message_type'        => 'error',
    //             'message_title'       => __('member::strings.error.title'),
    //             'message_description' => __('member::strings.error.description'),
    //             'errors'              => [
    //                 'exception' => [
    //                     'message' => $e->getMessage(),
    //                     'code'    => $e->getCode(),
    //                     'line'    => $e->getLine(),
    //                     'file'    => $e->getFile(),
    //                 ],
    //             ],
    //             'redirect_url'        => route('AuthController@twoFactorUnlock'),
    //         ], 500);
    //     }

    //     return new CrudResponse([
    //         'success'             => true,
    //         'type'                => 'empty',
    //         'message_type'        => 'success',
    //         'message_title'       => '',
    //         'message_description' => '',
    //         'errors'              => [],
    //         'redirect_url'        => route('AuthController@twoFactorUnlock'),
    //     ], 200);
    // }
}
