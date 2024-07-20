<?php

namespace Elegant\Utils\Http\Middleware;

use Closure;
use Elegant\Utils\Facades\Admin;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Admin::bootstrap();

        return $next($request);
    }
}
