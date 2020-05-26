<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Scim controller.
 */
class ScimController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function allUsers(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function fetchUser(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function createUser(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function updateUser(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function deleteUser(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function allGroups(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function fetchGroup(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function createGroup(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function updateGroup(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function deleteGroup(string $key): JsonResponse
    {
        throw new NotImplemented();
    }
}
