<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\ModelOperations;
use Directus\Events\SettingChanged;
use Directus\Exceptions\SettingNotCreated;
use Directus\Exceptions\SettingNotFound;
use Illuminate\Database\Eloquent\Model;

/**
 * Setting model.
 *
 * @property string $key
 * @property mixed  $value
 *
 * @mixin Model
 */
class Setting extends Model
{
    use FromSystemDatabase;
    use ModelOperations;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var array<string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];

    /**
     * @var array<string>
     */
    private static $exceptions = [
        'not_found' => SettingNotFound::class,
        'not_created' => SettingNotCreated::class,
    ];

    /**
     * @return mixed
     */
    public static function fromKey(string $key)
    {
        /** @var Setting $setting */
        $setting = self::findOrFail($key);

        return $setting->value;
    }

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::saved(static function (Setting $instance): void {
            event(new SettingChanged($instance));
        });
    }
}
