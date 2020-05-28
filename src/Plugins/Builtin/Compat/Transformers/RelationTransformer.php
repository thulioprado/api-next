<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class RelationTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.relations.all',
            Closure::fromCallable([$this, 'list'])
        );

        $events->listen(
            'directus.response.route.project.relations.fetch',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.relations.create',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.relations.update',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.relations.delete',
            Closure::fromCallable([$this, 'delete'])
        );
    }

    public function list(Response $response): void
    {
        $relations = collect($response->get('data.relations'))->map([$this, 'hydrate']);

        $response->set('data', $relations);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.relation')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $relation): array
    {
        return $relation;
    }
}
