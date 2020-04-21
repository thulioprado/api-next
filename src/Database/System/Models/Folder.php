<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * Collection model.
 *
 * @property string      $id
 * @property null|string $parent_id
 * @property string      $name
 *
 * @mixin Model
 * @mixin Builder
 */
class Folder extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'parent_id',
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        'parent_folder',
    ];

    /**
     * Get the parent folder.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    /**
     * Get the child folders.
     */
    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    /**
     * Get the parent folder.
     */
    public function getParentFolderAttribute(): ?string
    {
        return $this->parent_id;
    }
}
