<?php

declare(strict_types=1);

namespace Directus\Laravel\Middlewares;

use Closure;
use Directus\Framework\Directus;
use Directus\Framework\Exception\DirectusException;
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
        /** @var Directus */
        $directus = resolve(Directus::class);

        /** @var Route */
        $route = $request->route();

        $parameters = $route->parameters();

        if (!\array_key_exists(self::COLLECTION_PARAMETER, $parameters)) {
            throw new DirectusException('Can\'t resolve collection on a route without {collection} parameter');
        }

        $route->setParameter(
            self::COLLECTION_PARAMETER,
            $directus->collection($parameters[self::COLLECTION_PARAMETER])
        );

        return $next($request);
    }
}
