<?php

namespace Elegant\Utils\Http\Middleware;

use Illuminate\Http\Request;

class Session
{
    public function handle(Request $request, \Closure $next)
    {
        $path = '/'.trim(config('elegant-utils.admin.route.prefix'), '/');

        config(['session.path' => $path]);

        if ($domain = config('elegant-utils.admin.route.domain')) {
            config(['session.domain' => $domain]);
        }

        return $next($request);
    }
}
