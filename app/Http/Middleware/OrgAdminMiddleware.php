<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(!Auth::user()->is_admin && !Auth::user()->organization){
                abort(403);
            }
            if(Auth::user()->is_admin || Auth::user()->is_org_admin){
                return $next($request);
            }
            abort(403);
        }
        return redirect(route('dashboard.login'));
    }
}
