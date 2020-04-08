<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Collection model.
 *
 * @property string $id
 * @property string $name
 * @property bool   $system
 *
 * @mixin Model
 * @mixin Builder
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
