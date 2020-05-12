<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\PresetNotCreated;
use Directus\Exceptions\PresetNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string      $id
 * @property null|string $title
 * @property null|string $collection_id
 * @property null|string $user_id
 * @property null|string $role_id
 * @property null|string $search_query
 * @property null|array  $filters
 * @property string      $view_type
 * @property null|string $view_query
 * @property null|array  $view_options
 * @property null|array  $translation
 *
 * @mixin Model
 */
class Preset extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array<string>
     */
    protected $casts = [
        'filters' => 'json',
        'view_options' => 'json',
        'translation' => 'json',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'search_query',
        'filters',
        'view_type',
        'view_query',
        'view_options',
        'translation',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => PresetNotFound::class,
        'not_created' => PresetNotCreated::class,
    ];

    /**
     * Gets the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Gets the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
