<?php

namespace Elegance\Admin\Http\Middleware;

use Closure;
use Elegance\Admin\Facades\Admin;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Admin::bootstrap();

        return $next($request);
    }
}
