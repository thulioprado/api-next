<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Collection model.
 *
 * @property string $id
 * @property string $title
 * @property string $collection_id
 * @property string $user_id
 * @property string $role_id
 * @property string $search_query
 * @property array  $filters
 * @property string $view_type
 * @property string $view_query
 * @property array  $view_options
 * @property array  $translation
 *
 * @mixin Model
 * @mixin Builder
 */
class CollectionPreset extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

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
}
