<?php

namespace Elegance\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            $request->setTrustedProxies(request()->getClientIps(), RequestAlias::HEADER_X_FORWARDED_FOR);

            $input = $request->input();

            foreach (config('admin.operation_logs.secrecy_keys') as $key) {
                if (isset($input[$key])) {
                    $input[$key] = '******';
                }
            }

            $log = [
                'user_id' => Auth::user()->id,
                'operation' => $request->route()->action['as'],
                'method'  => $request->method(),
                'path'    => $request->path(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($input),
            ];

            try {
                $logModel = config('admin.database.log_model');
                $logModel::create($log);
            } catch (\Exception $exception) {
                // pass
            }
        }

        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldLogOperation(Request $request): bool
    {
        return Auth::user() && config('admin.operation_logs.enable') && $this->inAllowedMethods($request->method()) && $this->notInExcept($request);
    }

    /**
     * Whether requests using this method are allowed to be logged.
     *
     * @param string $method
     *
     * @return bool
     */
    protected function inAllowedMethods(string $method): bool
    {
        $allowedMethods = collect(config('admin.operation_logs.allowed_methods'))->filter();

        if ($allowedMethods->isEmpty()) {
            return true;
        }

        return $allowedMethods->map(function ($method) {
            return strtoupper($method);
        })->contains($method);
    }

    /**
     * Determine if the request has a URI that should pass through CSRF verification.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function notInExcept(Request $request): bool
    {
        return !in_array($request->route()->action['as'], config('admin.operation_logs.excepts'));
    }
}
