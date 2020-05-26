<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Auth controller.
 */
class AuthController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function authenticate(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function sessions(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function logout(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function logoutUser(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function logoutUserId(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function requestPassword(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function resetPassword(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function refresh(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function sso(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function ssoAccessToken(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function ssoFetchProvider(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function ssoCreateProvider(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function ssoProviderCallback(string $key): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function check(string $key): JsonResponse
    {
        throw new NotImplemented();
    }
}
