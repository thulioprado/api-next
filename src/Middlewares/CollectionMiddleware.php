<?php

declare(strict_types=1);

namespace Directus\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CollectionMiddleware
{
    /**
     * Collection parameter.
     */
    private const COLLECTION_PARAMETER = 'collection';

    /**
     * Performs identification on incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Route $route */
        $route = $request->route();

        $parameters = $route->parameters();

        if (!\array_key_exists(self::COLLECTION_PARAMETER, $parameters)) {
            throw new \Exception('Can\'t resolve collection on a route without {collection} parameter');
        }

        $route->setParameter(
            self::COLLECTION_PARAMETER,
            \Directus\Facades\Directus::database()->collection($parameters[self::COLLECTION_PARAMETER])
        );

        return $next($request);
    }
}
