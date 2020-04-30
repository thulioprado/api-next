<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\RoleNotCreated;
use Directus\Exceptions\RoleNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Collection model.
 *
 * @property string      $id
 * @property null|string $external_id
 * @property string      $name
 * @property null|string $description
 * @property null|array  $module_listing
 * @property null|array  $collection_listing
 * @property null|string $ip_whitelist
 * @property bool        $enforce_2fa
 *
 * @mixin Model
 * @mixin Builder
 */
class Role extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array
     */
    protected $casts = [
        'module_listing' => 'json',
        'collection_listing' => 'json',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'external_id',
        'name',
        'description',
        'module_listing',
        'collection_listing',
        'ip_whitelist',
        'enforce_2fa',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => RoleNotFound::class,
        'not_created' => RoleNotCreated::class,
    ];

    /**
     * Get the users.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Gets the collection presets.
     */
    public function collectionPresets(): HasMany
    {
        return $this->hasMany(CollectionPreset::class);
    }

    /**
     * Gets the permissions.
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
