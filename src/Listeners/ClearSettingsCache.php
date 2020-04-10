<?php

declare(strict_types=1);

namespace Directus\Listeners;

use Directus\Events\SettingChanged;

class ClearSettingsCache
{
    /**
     * Whenever settings changes.
     */
    public function handle(SettingChanged $event): void
    {
        // TODO: forget cache entries
    }
}
