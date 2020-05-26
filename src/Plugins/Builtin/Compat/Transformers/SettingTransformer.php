<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class SettingTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.response.route.project.settings.all', [$this, 'list']);
        $events->listen('directus.response.route.project.settings.fetch', [$this, 'one']);
        $events->listen('directus.response.route.project.settings.create', [$this, 'one']);
        $events->listen('directus.response.route.project.settings.update', [$this, 'one']);
        $events->listen('directus.response.route.project.settings.delete', [$this, 'delete']);
    }

    public function list(Response $response): void
    {
        $settings = collect($response->get('data.settings'))->map([$this, 'hydrate']);

        $response->set('data', $settings);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.setting')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $setting)
    {
        return $setting;
    }
}
