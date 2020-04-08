<?php

declare(strict_types=1);

namespace Directus\Middlewares;

use Closure;
use Illuminate\Http\Request;

class DirectusMiddleware
{
    /**
     * Performs directus middleware on incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
