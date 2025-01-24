<?php

namespace Elegance\Admin\Http\Middleware;

use Closure;
use Elegance\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        if (Auth::user()->canAccessRoute($request->route())) {
            return $next($request);
        }

        if (!$request->pjax() && $request->ajax()) {
            abort(403, trans('admin.deny'));
        }

        Pjax::respond(response(new Content(function (Content $content) use ($request) {
            $content->title(trans('admin.deny'))->view('admin::pages.deny');
        })));
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request): bool
    {
        return in_array($request->route()->getAction()['as'], config('admin.route.excepts'));
    }
}
