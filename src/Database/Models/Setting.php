<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use Directus\Database\Traits\FromSystemDatabase;
use Directus\Events\SettingChanged;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Setting model.
 *
 * @property string $key
 * @property mixed  $value
 *
 * @mixin Model
 * @mixin Builder
 */
class Setting extends Model
{
    use FromSystemDatabase;

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
     * @var array
     */
    protected $casts = [
        'value' => 'json',
    ];

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
