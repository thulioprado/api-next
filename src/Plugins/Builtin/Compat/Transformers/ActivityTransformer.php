<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class ActivityTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.activities.all', [$this, 'list']);
        $events->listen('directus.response.route.project.activities.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.activities.comment.create', [$this, 'one']);
        $events->listen('directus.response.route.project.activities.comment.update', [$this, 'one']);
        $events->listen('directus.response.route.project.activities.comment.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $activities = collect($response->get('data.activities'))->map([$this, 'hydrate']);

        $response->set('data', $activities);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.activity')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $activity): array
    {
        return $activity;
    }
}
