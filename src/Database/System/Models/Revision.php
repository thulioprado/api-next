<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

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
 * @mixin Builder
 */
class Revision extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

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
        'id',
        'item',
        'data',
        'delta',
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
     * Get the activity.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    /**
     * Get the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    /**
     * Get the parent collection.
     */
    public function parentCollection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'parent_collection_id');
    }
}
