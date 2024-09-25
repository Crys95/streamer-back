<?php

namespace Tests\Mocks\Middleware;

use Closure;
use Illuminate\Http\Request;

class MockBasicMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Usado pra fazer teste de integração
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
