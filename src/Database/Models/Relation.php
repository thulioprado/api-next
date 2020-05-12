<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\RelationNotCreated;
use Directus\Exceptions\RelationNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string $id
 * @property string $field_many_id
 * @property string $field_one_id
 * @property string $junction_field_id
 *
 * @mixin Model
 */
class Relation extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'field_many_id',
        'field_one_id',
        'junction_field_id',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'field_many_id',
        'field_one_id',
        'junction_field_id',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => RelationNotFound::class,
        'not_created' => RelationNotCreated::class,
    ];

    /**
     * Gets the field many.
     */
    public function fieldMany(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'field_many_id');
    }

    /**
     * Gets the field one.
     */
    public function fieldOne(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'field_one_id');
    }

    /**
     * Gets the junction field.
     */
    public function junctionField(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'junction_field_id');
    }
}
