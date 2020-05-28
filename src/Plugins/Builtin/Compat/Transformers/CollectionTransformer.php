<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class CollectionTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.collections.all',
            Closure::fromCallable([$this, 'list'])
        );

        $events->listen(
            'directus.response.route.project.collections.fetch',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.collections.create',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.collections.update',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.collections.delete',
            Closure::fromCallable([$this, 'delete'])
        );
    }

    public function list(Response $response): void
    {
        $collections = collect($response->get('data.collections'))->map([$this, 'hydrate']);

        $response->set('data', $collections);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.collection')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $collection): array
    {
        return $collection;
    }
}
