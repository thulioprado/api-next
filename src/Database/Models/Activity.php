<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\ActivityNotCreated;
use Directus\Exceptions\ActivityNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Collection model.
 *
 * @property string        $id
 * @property string        $collection_id
 * @property string        $action
 * @property null|string   $action_by
 * @property null|DateTime $action_on
 * @property string        $ip
 * @property string        $user_agent
 * @property array         $item
 * @property null|DateTime $edited_on
 * @property null|string   $comment
 * @property null|DateTime $comment_deleted_on
 *
 * @mixin Model
 */
class Activity extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array
     */
    protected $casts = [
        'item' => 'json',
        'action_on' => 'datetime',
        'edited_on' => 'datetime',
        'comment_deleted_on' => 'datetime',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => ActivityNotFound::class,
        'not_created' => ActivityNotCreated::class,
    ];

    /**
     * Gets the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Gets the revisions.
     */
    public function revisions(): HasMany
    {
        return $this->hasMany(Revision::class);
    }
}
