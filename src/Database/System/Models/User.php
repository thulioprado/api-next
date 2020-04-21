<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
 *
 * @mixin Model
 * @mixin Builder
 */
class User extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

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
        'status',
        'first_name',
        'last_name',
        'email',
        'password',
        'token',
        'timezone',
        'locale',
        'locale_options',
        'company',
        'title',
        'email_notifications',
        'last_access_on',
        'last_page',
        'theme',
        'twofactor_secret',
        'password_reset_token',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'twofactor_secret',
    ];

    /**
     * @var array<string>
     */
    protected $appends = [
        '2fa_secret',
    ];

    /**
     * Set the user password.
     */
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get the 2fa_secret.
     */
    public function get2faSecretAttribute(): ?string
    {
        return $this->twofactor_secret;
    }
}
