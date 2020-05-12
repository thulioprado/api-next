<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\RevisionNotCreated;
use Directus\Exceptions\RevisionNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string      $id
 * @property string      $activity_id
 * @property string      $collection_id
 * @property string      $item
 * @property string      $data
 * @property null|string $delta
 * @property null|string $parent_collection_id
 * @property null|string $parent_item
 * @property bool        $parent_changed
 *
 * @mixin Model
 */
class Revision extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'json',
        'delta' => 'json',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'activity_id',
        'collection_id',
        'item',
        'data',
        'delta',
        'parent_collection_id',
        'parent_item',
        'parent_changed',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'activity_id',
        'collection_id',
        'parent_collection_id',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => RevisionNotFound::class,
        'not_created' => RevisionNotCreated::class,
    ];

    /**
     * Gets the activity.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Gets the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Gets the parent collection.
     */
    public function parentCollection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'parent_collection_id');
    }
}
