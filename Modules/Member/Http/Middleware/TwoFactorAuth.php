<?php

namespace Modules\Member\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorAuth
{
    protected $data = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! auth()->check() ) {
            return $next($request);
        }

        if (empty(auth()->user()->login_code)) {
            return $next($request);
        }

        if ( ! config('admin.two_factor_login.active') ) {
            return $next($request);
        }

        if ( ! in_array($request->url(), [route('AuthController@twoFactorUnlock'), route('AuthController@postTwoFactorUnlock'), route('AuthController@sendTwoFactorUnlock')]) ) {
            return redirect()->route('AuthController@twoFactorUnlock')->send();
        }

        return $next($request);
    }
}
