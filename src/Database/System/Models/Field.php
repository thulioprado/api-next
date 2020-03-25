<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Field model.
 *
 * @property string $id
 */
class Field extends Model
{
    use SystemModel;

    /**
     * Gets the parent collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
