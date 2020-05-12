<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\FolderNotCreated;
use Directus\Exceptions\FolderNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Collection model.
 *
 * @property string      $id
 * @property null|string $parent_id
 * @property string      $name
 *
 * @mixin Model
 */
class Folder extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'parent_id',
        'name',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => FolderNotFound::class,
        'not_created' => FolderNotCreated::class,
    ];

    /**
     * Gets the parent folder.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    /**
     * Gets the children.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    /**
     * Gets the files.
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
