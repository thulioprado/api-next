<?php

declare(strict_types=1);

namespace Directus\Events;

use Directus\Database\System\Models\Setting;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SettingChanged
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @var Setting
     */
    private $setting;

    /**
     * SettingChangedEvent constructor.
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Related setting.
     */
    public function setting(): Setting
    {
        return $this->setting;
    }
}
