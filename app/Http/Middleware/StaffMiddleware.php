<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StaffMiddleware
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
        if((Auth::check() && Auth::user()->is_admin) || (Auth::check() && Auth::user()->is_staff)){
            return $next($request);
        }
        elseif (Auth::check()) {
            abort(403);
        }
        return redirect(route('dashboard.login'));
    }
}