<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Directus\Exceptions\Traits\SmartException;
use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exception.
 */
class RequestValidationFailed extends Exception
{
    use SmartException;

    /** @var int */
    private static $status = Response::HTTP_UNPROCESSABLE_ENTITY;
}
