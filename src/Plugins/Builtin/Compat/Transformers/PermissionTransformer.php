<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class PermissionTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.permissions.all', [$this, 'list']);
        $events->listen('directus.response.route.project.permissions.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.permissions.create', [$this, 'one']);
        $events->listen('directus.response.route.project.permissions.update', [$this, 'one']);
        $events->listen('directus.response.route.project.permissions.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $permissions = collect($response->get('data.permissions'))->map([$this, 'hydrate']);

        $response->set('data', $permissions);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.permission')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $permission): array
    {
        return $permission;
    }
}
