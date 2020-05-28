<?php

declare(strict_types=1);

namespace Directus\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RequestMiddleware
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Route $route */
        $route = request()->route();

        event('directus.request.'.$route->getName(), $request);

        return $next($request);
    }
}
