<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\WebhookNotCreated;
use Directus\Exceptions\WebhookNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string      $id
 * @property string      $status
 * @property null|string $http_action
 * @property null|string $url
 * @property null|string $collection_id
 * @property null|string $directus_action
 *
 * @mixin Model
 */
class Webhook extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'status',
        'http_action',
        'url',
        'collection_id',
        'directus_action',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'collection_id',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => WebhookNotFound::class,
        'not_created' => WebhookNotCreated::class,
    ];

    /**
     * Gets the collection.
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }
}
