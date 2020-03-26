<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Illuminate\Http\Response;

/**
 * Not implemented exception.
 */
class NotImplemented extends Exception
{
    /**
     * Not implemented exception constructor.
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

        parent::__construct('not_implemented', Response::HTTP_NOT_IMPLEMENTED, [
            'message' => 'Method not implemented: '.$method,
        ]);
    }
}
