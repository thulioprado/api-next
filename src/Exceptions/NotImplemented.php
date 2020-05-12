<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;

/**
 * DirectusException.
 */
class NotImplemented extends Exception
{
    use SmartException {
        __construct as initialize;
    }

    /**
     * DirectusException constructor.
     */
    public function __construct(?string $method = null)
    {
        parent::__construct();

        if ($method === null) {
            $trace = $this->getTrace()[0];
            if (isset($trace['class']) && $trace['class'] !== '') {
                $method = $trace['class'].':'.$trace['function'];
            } else {
                $method = $trace['function'];
            }
        }

        $this->initialize([
            'method' => $method,
        ]);
    }
}
