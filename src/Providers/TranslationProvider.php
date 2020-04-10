<?php

declare(strict_types=1);

namespace Directus\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Config provider.
 */
class TranslationProvider extends ServiceProvider
{
    /**
     * Service boot.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'directus');
        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/directus'),
        ], [
            'directus',
            'directus-lang',
        ]);
    }
}
