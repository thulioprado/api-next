<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * DirectusException.
 */
class SettingAlreadyExists extends DirectusException
{
    /**
     * DirectusException constructor.
     */
    public function __construct(string $key)
    {
        parent::__construct(Errors::SETTING_ALREADY_EXISTS, [
            'key' => $key,
        ]);
    }
}
