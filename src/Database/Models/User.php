<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Directus\Exceptions\UserNotCreated;
use Directus\Exceptions\UserNotFound;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Collection model.
 *
 * @property string        $id
 * @property null|string   $role_id
 * @property string        $status
 * @property null|string   $first_name
 * @property null|string   $last_name
 * @property string        $email
 * @property null|string   $password
 * @property null|string   $token
 * @property string        $timezone
 * @property null|string   $locale
 * @property null|string   $locale_options
 * @property null|string   $avatar_id
 * @property null|string   $company
 * @property null|string   $title
 * @property bool          $email_notifications
 * @property null|DateTime $last_access_on
 * @property null|string   $last_page
 * @property null|string   $external_id
 * @property string        $theme
 * @property null|string   $twofactor_secret
 * @property null|string   $password_reset_token
 * @property Role          $role
 *
 * @mixin Model
 */
class User extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;
    use ModelOperations;

    /**
     * @var array
     */
    protected $casts = [
        'last_access_on' => 'datetime',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'role_id',
        'status',
        'first_name',
        'last_name',
        'email',
        'password',
        'token',
        'timezone',
        'locale',
        'locale_options',
        'avatar_id',
        'company',
        'title',
        'email_notifications',
        'last_access_on',
        'last_page',
        'external_id',
        'theme',
        'twofactor_secret',
        'password_reset_token',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'role_id',
        'avatar_id',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => UserNotFound::class,
        'not_created' => UserNotCreated::class,
    ];

    /**
     * Gets the role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Gets the sessions.
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Gets the collection presets.
     */
    public function presets(): HasMany
    {
        return $this->hasMany(Preset::class);
    }

    /**
     * Sets the user password attribute.
     */
    public function setPasswordAttribute(?string $value): void
    {
        if ($value !== null) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
