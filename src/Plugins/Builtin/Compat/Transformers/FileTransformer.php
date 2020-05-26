<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class FileTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.files.all', [$this, 'list']);
        $events->listen('directus.response.route.project.files.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.files.create', [$this, 'one']);
        $events->listen('directus.response.route.project.files.update', [$this, 'one']);
        $events->listen('directus.response.route.project.files.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $files = collect($response->get('data.files'))->map([$this, 'hydrate']);

        $response->set('data', $files);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.file')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    public function hydrate(array $file): array
    {
        return $file;
    }
}
