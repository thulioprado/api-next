<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat;

use Directus\Contracts\Plugins\Plugin;
use Directus\Plugins\Builtin\Compat\Transformers\ActivityTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\AssetTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\CollectionTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\FieldTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\FileTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\FolderTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\PermissionTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\PresetTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\RelationTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\RevisionTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\RoleTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\ServerTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\UserTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\UtilTransformer;
use Directus\Plugins\Builtin\Compat\Transformers\WebhookTransformer;
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
        Event::subscribe(ServerTransformer::class);
        Event::subscribe(FileTransformer::class);
        Event::subscribe(AssetTransformer::class);
        Event::subscribe(ActivityTransformer::class);
        Event::subscribe(CollectionTransformer::class);
        Event::subscribe(PresetTransformer::class);
        Event::subscribe(FieldTransformer::class);
        Event::subscribe(FolderTransformer::class);
        Event::subscribe(PermissionTransformer::class);
        Event::subscribe(RelationTransformer::class);
        Event::subscribe(RevisionTransformer::class);
        Event::subscribe(RoleTransformer::class);
        Event::subscribe(UserTransformer::class);
        Event::subscribe(UtilTransformer::class);
        Event::subscribe(WebhookTransformer::class);
    }

    public function boot(): void
    {
    }
}
