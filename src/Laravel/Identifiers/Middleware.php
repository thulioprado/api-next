<?php

namespace Directus\Laravel\Identifiers;

use Closure;
use Directus\Laravel\Contracts\Identifiers\Identifier;
use Illuminate\Http\Request;

class Middleware
{
    /**
     * Performs identification on incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Identifier */
        $identifier = resolve(Identifier::class);

        if (!$identifier->identified() && !$identifier->identify()) {
            throw new \Exception('Unable to identify working project.');
        }

        return $next($request);
    }
}
