<?php

namespace alessandrobelli\Lingua\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        if (! in_array(auth()->user()->email, config('lingua.'.$role))) {
            return response('Unauthorized', 403);
        }

        return $next($request);
    }
}
