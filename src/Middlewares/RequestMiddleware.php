<?php

declare(strict_types=1);

namespace Directus\Middlewares;

use Closure;
use Illuminate\Http\Request;

class RequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        event('directus.request.'.$request->route()->getName(), $request);

        return $next($request);
    }
}
