<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!app('Illuminate\Contracts\Auth\Guard')->guest()) {
            if ($request->user()->id == 1) { //By pass root user
                return $next($request);
            }

            $can = $this->userCanAccessTo($request);

            if ($can) {
                return $next($request);
            }

            return $request->ajax ? response('Unauthorized.', 401) : redirect()->route('backend.error.index.get', ['401', 'unauthorized']);
            ;
        }
    }

    /**
     * Checking the permission.
     *
     * @param  object $request
     * @return boolean
     */
    protected function userCanAccessTo($request)
    {
        return $this->hasPermission($request);
    }

    /**
     * Asking for the permission.
     *
     * @param  object $request
     * @return boolean
     */
    protected function hasPermission($request)
    {
        // Permision requested.
        $required = $this->requiredPermission($request);

        // If permission doesn't define, so let the user in.
        if (is_null($required)) {
            return true;
        }

        if (!is_array($required)) {
            $required = [$required];
        }

        return $request->user()->can($required);
    }

    /**
     * Permission require from the route.
     *
     * @param  object $request
     * @return array
     */
    protected function requiredPermission($request)
    {
        $action = $request->route()->getAction();

        list($controller, $action) = explode('@', $action['controller']);

        $allPermissions = $controller::$requiredPermissions;

        return isset($allPermissions[$action]) ? $allPermissions[$action] : null;
    }
}
