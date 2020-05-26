<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class RevisionTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.revisions.all', [$this, 'list']);
        $events->listen('directus.response.route.project.revisions.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.*.revisions', [$this, 'list']);
    }

    public function list(Response $response): void
    {
        $revisions = collect($response->get('data.revisions'))->map([$this, 'hydrate']);

        $response->set('data', $revisions);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.revision')));
    }

    private function hydrate(array $revision): array
    {
        return $revision;
    }
}
