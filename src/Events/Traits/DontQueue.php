<?php

declare(strict_types=1);

namespace Directus\Events\Traits;

trait DontQueue
{
    public function shouldQueue(): bool
    {
        return false;
    }
}
