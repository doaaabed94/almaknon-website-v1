<?php

namespace Modules\Member\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NeedPermissions
{
    protected $data = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if ( auth()->check() ) {
            $this->data['User'] = $request->user();
            if ( $this->data['User']->isAn('ROOT') ) {
                return $next($request);
            }
            foreach ($permissions as $i => $PermissionCode) {
                if ( $this->data['User']->can( $PermissionCode ) ) {
                    return $next($request);
                }
            }
        }
        if (in_array('GUEST', $permissions)) {
            return $next($request);
        }
        if ($request->ajax()) {
            return response()->json([
                'success'             => false,
                'type'                => 'toastr',
                'message_type'        => 'error',
                'message_title'       => __('member::strings.permissions_error.title'),
                'message_description' => __('member::strings.permissions_error.description'),
                'errors'              => []
            ], 403);
        }
        return redirect()->back()->withInput()->with('result', [
            'success'             => false,
            'type'                => 'toastr',
            'message_type'        => 'error',
            'message_title'       => __('member::strings.permissions_error.title'),
            'message_description' => __('member::strings.permissions_error.description'),
            'errors'              => []
        ]);
    }
}
