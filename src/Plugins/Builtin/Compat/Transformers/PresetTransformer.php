<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Closure;
use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;

class PresetTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            'directus.response.route.project.presets.all',
            Closure::fromCallable([$this, 'list'])
        );

        $events->listen(
            'directus.response.route.project.presets.fetch',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.presets.create',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.presets.update',
            Closure::fromCallable([$this, 'one'])
        );

        $events->listen(
            'directus.response.route.project.presets.delete',
            Closure::fromCallable([$this, 'delete'])
        );
    }

    public function list(Response $response): void
    {
        $presets = collect($response->get('data.presets'))->map([$this, 'hydrate']);

        $response->set('data', $presets);
    }

    public function one(Response $response): void
    {
        $response->set('data', $this->hydrate($response->get('data.preset')));
    }

    public function delete(Response $response): void
    {
        $response->setContent('')->setStatusCode(204);
    }

    private function hydrate(array $preset): array
    {
        return $preset;
    }
}
