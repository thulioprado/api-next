<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\CollectionNotCreated;
use Directus\Exceptions\CollectionNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 */
class Collection extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

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
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => CollectionNotFound::class,
        'not_created' => CollectionNotCreated::class,
    ];

    /**
     * Gets the activities.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Gets the collection presets.
     */
    public function collectionPresets(): HasMany
    {
        return $this->hasMany(Preset::class);
    }

    /**
     * Gets the related fields.
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    /**
     * Gets the permissions.
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Gets the revisions.
     */
    public function revisions(): HasMany
    {
        return $this->hasMany(Revision::class);
    }

    /**
     * Gets the webhooks.
     */
    public function webhooks(): HasMany
    {
        return $this->hasMany(Webhook::class);
    }
}
