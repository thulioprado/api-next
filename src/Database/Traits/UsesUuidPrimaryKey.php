<?php

declare(strict_types=1);

namespace Directus\Database\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Uuid primary key.
 *
 * @mixin Model
 */
trait UsesUuidPrimaryKey
{
    public function getKeyType(): string
    {
        return 'uuid';
    }

    public function getIncrementing(): bool
    {
        return false;
    }
}
