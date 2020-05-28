<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class AssetTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.asset',
            Closure::fromCallable([$this, 'one'])
        );
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.asset')));
    }

    private function hydrate(array $asset): array
    {
        // TODO: needs to be implemented

        return $asset;
    }
}
