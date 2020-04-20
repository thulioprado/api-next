<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * Collection model.
 *
 * @property string          $id
 * @property null|string     $collection_id
 * @property null|Collection $collection
 * @property string          $action
 * @property null|string     $action_by
 * @property DateTime        $action_on
 * @property null|string     $ip
 * @property null|string     $user_agent
 * @property null|array      $item
 * @property null|DateTime   $edited_on
 * @property null|string     $comment
 * @property null|DateTime   $comment_deleted_on
 *
 * @mixin Model
 * @mixin Builder
 */
class Activity extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array
     */
    protected $casts = [
        'item' => 'json',
        'action_on' => 'datetime',
        'edited_on' => 'datetime',
        'comment_deleted_on' => 'datetime',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
