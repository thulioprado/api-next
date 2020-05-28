<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class UtilTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.utils.*',
            Closure::fromCallable([$this, 'response'])
        );
    }

    public function response(Response $response): void
    {
        $response->set('data', $response->get('data'));
    }
}
