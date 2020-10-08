<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $requestedRole)
    {
        $user = Auth::user();
        foreach ($user->role as $roleCheck) { //Compare requested role with all user roles
            if ($roleCheck->name === $requestedRole || $roleCheck->name === 'admin') {
                return $next($request);
            } //Then return true if roles matches
        }
    }
}
