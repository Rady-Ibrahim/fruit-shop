<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        // منطق التحقق من الدور
        return $next($request);
    }
}