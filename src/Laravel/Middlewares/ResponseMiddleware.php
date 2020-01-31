<?php

declare(strict_types=1);

namespace Directus\Laravel\Middlewares;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Response middleware.
 */
final class ResponseMiddleware
{
    /**
     * The Response Factory our app uses.
     *
     * @var ResponseFactory
     */
    private $factory;

    /**
     * JsonMiddleware constructor.
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
