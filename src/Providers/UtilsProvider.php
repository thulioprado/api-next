<?php

declare(strict_types=1);

namespace Directus\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

/**
 * Utils provider.
 */
class UtilsProvider extends ServiceProvider
{
    /**
     * Service register.
     */
    public function register(): void
    {
        Arr::macro('rename', function (array $object, array $map): array {
            foreach ($map as $from => $to) {
                if (!Arr::has($object, [$from])) {
                    continue;
                }

                $value = Arr::get($object, $from);
                $object = Arr::except($object, [$from]);
                $object = Arr::set($object, $to, $value);
            }

            return $object;
        });
    }
}
