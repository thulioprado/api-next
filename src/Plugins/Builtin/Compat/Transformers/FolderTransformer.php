<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class FolderTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.folders.all', [$this, 'list']);
        $events->listen('directus.response.route.project.folders.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.folders.create', [$this, 'one']);
        $events->listen('directus.response.route.project.folders.update', [$this, 'one']);
        $events->listen('directus.response.route.project.folders.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $folders = collect($response->get('data.folders'))->map([$this, 'hydrate']);

        $response->set('data', $folders);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.folder')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $folder): array
    {
        return $folder;
    }
}
