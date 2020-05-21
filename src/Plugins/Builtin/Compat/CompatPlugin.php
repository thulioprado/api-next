<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat;

use Directus\Contracts\Plugins\Plugin;
use Directus\Plugins\Builtin\Compat\Transformers\PingTransformer;
use Illuminate\Support\Facades\Event;

class CompatPlugin implements Plugin
{
    public function info(): array
    {
        return [
            'description' => 'Provides backwards compatibility with v8 and v9.',
        ];
    }

    public function dependencies(): array
    {
        return [];
    }

    public function register(): void
    {
        Event::listen('directus.response.route.server.ping', [PingTransformer::class, 'transform']);
    }

    public function boot(): void
    {
    }
}
