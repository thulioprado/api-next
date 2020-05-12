<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\SessionNotCreated;
use Directus\Exceptions\SessionNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string        $id
 * @property null|string   $user_id
 * @property null|string   $token_type
 * @property null|string   $token
 * @property null|string   $ip_address
 * @property null|string   $user_agent
 * @property null|DateTime $created_on
 * @property null|DateTime $token_expired_at
 *
 * @mixin Model
 */
class Session extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array
     */
    protected $casts = [
        'created_on' => 'datetime',
        'token_expired_at' => 'datetime',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'token_type',
        'token',
        'ip_address',
        'user_agent',
        'created_on',
        'token_expired_at',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => SessionNotFound::class,
        'not_created' => SessionNotCreated::class,
    ];

    /**
     * Gets the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
