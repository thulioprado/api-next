<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class FieldTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.fields.all', [$this, 'list']);
        $events->listen('directus.response.route.project.fields.collection.all', [$this, 'list']);
        $events->listen('directus.response.route.project.fields.collection.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.fields.collection.create', [$this, 'one']);
        $events->listen('directus.response.route.project.fields.collection.update', [$this, 'one']);
        $events->listen('directus.response.route.project.fields.collection.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $fields = collect($response->get('data.fields'))->map([$this, 'hydrate']);

        $response->set('data', $fields);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.field')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $field): array
    {
        return $field;
    }
}
