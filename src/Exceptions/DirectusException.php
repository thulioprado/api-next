<?php

declare(strict_types=1);

namespace Directus\Exceptions;

use Illuminate\Http\JsonResponse;

/**
 * Not implemented exception.
 */
class DirectusException extends \Exception
{
    /**
     * DirectusException code.
     *
     * @var string
     */
    protected $code;

    /**
     * DirectusException description.
     *
     * @var array<string>
     */
    protected $context;

    /**
     * DirectusException constructor.
     */
    public function __construct(string $code, array $context = [])
    {
        $this->code = $code;
        $this->context = $context;
        parent::__construct();
    }

    /**
     * DirectusException response renderer.
     */
    public function render(): JsonResponse
    {
        return directus()->respond()->withError($this->code, $this->context);
    }
}
