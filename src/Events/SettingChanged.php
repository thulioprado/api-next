<?php

declare(strict_types=1);

namespace Directus\Events;

use Directus\Database\Models\Setting;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SettingChanged
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @var Setting
     */
    public $setting;

    /**
     * SettingChangedEvent constructor.
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
}
