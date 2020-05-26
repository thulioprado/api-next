<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Item controller.
 */
class ItemController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function all(string $collection): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function fetch(string $collection, string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function create(string $collection): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function update(string $collection, string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function delete(string $collection, string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function revisions(string $collection, string $key, string $offset = null): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function revert(string $collection, string $key, string $revision): JsonResponse
    {
        throw new NotImplemented();
    }
}
