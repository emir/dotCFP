<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $roles
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function handle($request, Closure $next, string $roles)
    {
        if (!in_array(auth()->user()->role, explode('|', $roles), true)) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        return $next($request);
    }
}
