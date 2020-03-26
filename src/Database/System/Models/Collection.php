<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Collection model.
 *
 * @property mixed $id
 * @property mixed $name
 */
class Collection extends Model
{
    use SystemModel;

    /**
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * Gets the related fields.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
