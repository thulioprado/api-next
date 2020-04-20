<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Collection model.
 *
 * @property string $id
 * @property string $name
 * @property bool   $hidden
 * @property bool   $single
 * @property bool   $system
 * @property string $icon
 * @property string $note
 * @property array  $translation
 *
 * @mixin Model
 * @mixin Builder
 */
class Collection extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array
     */
    protected $casts = [
        'hidden' => 'bool',
        'single' => 'bool',
        'system' => 'bool',
        'translation' => 'json',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'hidden',
        'single',
        'system',
        'icon',
        'note',
        'translation',
    ];

    /**
     * Gets the related fields.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
