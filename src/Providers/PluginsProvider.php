<?php

declare(strict_types=1);

namespace Directus\Providers;

use Directus\Contracts\Plugins\Plugin;
use Directus\Exceptions\InvalidPlugin;
use Directus\Plugins\Repository;
use Illuminate\Support\ServiceProvider;
use WoLfulus\Extras\Package;

/**
 * Commands provider.
 */
class PluginsProvider extends ServiceProvider
{
    /**
     * @var array<Plugin>
     */
    private $plugins = [];

    /**
     * Service boot.
     */
    public function register(): void
    {
        $packages = Repository::get();

        /** @var Package $package */
        foreach ($packages as $package) {
            $metadata = collect($package->data());

            $plugins = $metadata->get('plugins', []);
            foreach ($plugins as $plugin) {
                $instance = new $plugin();
                if (!($instance instanceof Plugin)) {
                    throw new InvalidPlugin();
                }

                $this->plugins[] = $instance;
            }
        }

        // TODO: sort topologically the dependencies

        /** @var Plugin $plugin */
        foreach ($this->plugins as $plugin) {
            $plugin->register();
        }
    }

    public function boot(): void
    {
        /** @var Plugin $plugin */
        foreach ($this->plugins as $plugin) {
            $plugin->boot();
        }
    }
}
