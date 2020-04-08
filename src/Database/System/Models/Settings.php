<?php

declare(strict_types=1);

namespace Directus\Database\System\Models;

use Directus\Database\System\Models\Traits\SystemModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Settings model.
 *
 * @property string $key
 * @property mixed  $value
 *
 * @mixin Model
 * @mixin Builder
 */
class Settings extends Model
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
}
