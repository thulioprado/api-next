<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Responses\Errors;

/**
 * DirectusException.
 */
class NotImplemented extends DirectusException
{
    /**
     * DirectusException constructor.
     */
    public function __construct(?string $method = null)
    {
        if ($method === null) {
            $trace = $this->getTrace()[0];
            if (isset($trace['class']) && $trace['class'] !== '') {
                $method = $trace['class'].':'.$trace['function'];
            } else {
                $method = $trace['function'];
            }
        }

        parent::__construct(Errors::NOT_IMPLEMENTED, [
            'method' => $method,
        ]);
    }
}
