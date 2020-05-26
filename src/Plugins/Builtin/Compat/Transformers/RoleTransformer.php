<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class RoleTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.roles.all', [$this, 'list']);
        $events->listen('directus.response.route.project.roles.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.roles.create', [$this, 'one']);
        $events->listen('directus.response.route.project.roles.update', [$this, 'one']);
        $events->listen('directus.response.route.project.roles.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $roles = collect($response->get('data.roles'))->map([$this, 'hydrate']);

        $response->set('data', $roles);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.role')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $role)
    {
        return $role;
    }
}
