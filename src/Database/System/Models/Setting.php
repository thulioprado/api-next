<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
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
    use SystemModel;

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
     * Events.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::saved(function ($setting): void {
            event(new SettingChanged($setting));
        });
    }
}
