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
 * @property string      $collection_id
 * @property string      $role_id
 * @property string      $create
 * @property string      $read
 * @property string      $update
 * @property string      $delete
 * @property string      $comment
 * @property string      $explain
 * @property null|string $status
 * @property null|array  $status_blacklist
 * @property null|array  $read_field_blacklist
 * @property null|array  $write_field_blacklist
 *
 * @mixin Model
 * @mixin Builder
 */
class Permission extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array
     */
    protected $casts = [
        'status_blacklist' => 'array',
        'read_field_blacklist' => 'array',
        'write_field_blacklist' => 'array',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'create',
        'read',
        'update',
        'delete',
        'comment',
        'explain',
        'status',
        'status_blacklist',
        'read_field_blacklist',
        'write_field_blacklist',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'collection_id',
        'role_id',
    ];

    /**
     * Get the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    /**
     * Get the role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
