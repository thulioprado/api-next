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
        'name',
        'description',
        'module_listing',
        'collection_listing',
        'ip_whitelist',
        'enforce_2fa',
    ];
}
