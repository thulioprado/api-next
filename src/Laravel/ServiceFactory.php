<?php

declare(strict_types=1);

use Directus\Core\Options\Options;

class ServiceFactory
{
    /**
     * Instantiates a provider with its arguments.
     *
     * @param [type] $data
     */
    public static function instantiate($data)
    {
        $options = new Options([
            'class',
            'arguments' => [
                'default' => [],
            ],
        ], $data);

        $providerClass = $options->get('provider');
        $providerArguments = $options->get('arguments');
    }
}
