<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Revision controller.
 */
class RelationController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function all(): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function fetch(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function create(): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function update(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function delete(string $key): JsonResponse
    {
        throw new NotImplemented();
    }
}
