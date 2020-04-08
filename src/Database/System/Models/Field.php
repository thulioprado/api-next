<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Field model.
 *
 * @property string $id
 *
 * @mixin Model
 * @mixin Builder
 */
class Field extends Model
{
    use SystemModel;

    /**
     * @var string
     */
    protected $keyType = 'uuid';

    /**
     * Gets the parent collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
