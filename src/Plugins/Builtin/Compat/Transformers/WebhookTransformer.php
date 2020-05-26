<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class WebhookTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.webhooks.all', [$this, 'list']);
        $events->listen('directus.response.route.project.webhooks.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.webhooks.create', [$this, 'one']);
        $events->listen('directus.response.route.project.webhooks.update', [$this, 'one']);
        $events->listen('directus.response.route.project.webhooks.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $webhooks = collect($response->get('data.webhooks'))->map([$this, 'hydrate']);

        $response->set('data', $webhooks);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.webhook')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $webhook)
    {
        return $webhook;
    }
}
