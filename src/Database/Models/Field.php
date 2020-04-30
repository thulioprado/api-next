<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Field model.
 *
 * @property string $id
 * @property string $collection_id
 * @property string $name
 * @property string $type
 * @property string $interface
 * @property array  $options
 * @property bool   $locked
 * @property string $validation
 * @property bool   $require
 * @property bool   $readonly
 * @property bool   $hidden_detail
 * @property bool   $hidden_browse
 * @property int    $index
 * @property string $width
 * @property string $group_id
 * @property string $note
 * @property array  $translation
 *
 * @mixin Model
 * @mixin Builder
 */
class Field extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array
     */
    protected $casts = [
        'required' => 'bool',
        'readonly' => 'bool',
        'hidden_detail' => 'bool',
        'hidden_browse' => 'bool',
        'index' => 'int',
        'locked' => 'bool',
        'translation' => 'json',
        'options' => 'json',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'collection_id',
        'name',
        'type',
        'interface',
        'options',
        'locked',
        'validation',
        'require',
        'readonly',
        'hidden_detail',
        'hidden_browse',
        'index',
        'width',
        'group_id',
        'note',
        'translation',
    ];

    /**
     * Gets the parent collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Gets the group.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Gets the children.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
