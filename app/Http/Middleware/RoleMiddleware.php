<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role_name)
    {
        if (\App\User::hasRoles($role_name))
        {
            return $next($request);
        }

        return back()->with('error', 'Access Denied');
    }
}
