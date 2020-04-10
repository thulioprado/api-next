<?php

declare(strict_types=1);

namespace Directus\Events\Traits;

trait AlwaysQueue
{
    public function shouldQueue(): bool
    {
        return true;
    }
}
