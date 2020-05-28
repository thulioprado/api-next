<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class WebhookTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.webhooks.all',
            Closure::fromCallable([$this, 'list'])
        );

        $events->listen(
            'directus.response.route.project.webhooks.fetch',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.webhooks.create',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.webhooks.update',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.webhooks.delete',
            Closure::fromCallable([$this, 'delete'])
        );
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

    private function hydrate(array $webhook): array
    {
        return $webhook;
    }
}
