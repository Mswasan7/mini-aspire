<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class RoleMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        if (!$request->user()->hasRole($role)) {
            abort(403, 'Access denied');
        }
        return $next($request);
    }
}
