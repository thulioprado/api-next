<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class UserTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.users.all', [$this, 'list']);
        $events->listen('directus.response.route.project.users.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.users.create', [$this, 'one']);
        $events->listen('directus.response.route.project.users.update', [$this, 'one']);
        $events->listen('directus.response.route.project.users.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $users = collect($response->get('data.users'))->map([$this, 'hydrate']);

        $response->set('data', $users);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.user')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $user)
    {
        return $user;
    }
}
