<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\PermissionNotCreated;
use Directus\Exceptions\PermissionNotFound;
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
    use ModelOperations;

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
        'collection_id',
        'role_id',
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
    private static $exceptions = [
        'not_found' => PermissionNotFound::class,
        'not_created' => PermissionNotCreated::class,
    ];

    /**
     * Gets the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Gets the role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
