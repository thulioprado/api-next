<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Carbon\Carbon;
use Directus\Database\Models\User;
use Directus\Exceptions\RoleNotFound;
use Directus\Exceptions\UserNotCreated;
use Directus\Exceptions\UserNotFound;
use Directus\Requests\UserInviteRequest;
use Directus\Requests\UserRequest;
use Directus\Requests\UserTrackingRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * User controller.
 */
class UserController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $users */
        $users = User::with(['role', 'sessions', 'collectionPresets'])->get();

        return directus()->respond()->with($users->toArray());
    }

    /**
     * @throws UserNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var User $user */
        $user = User::with(['role', 'sessions', 'collectionPresets'])->findOrFail($key);

        return directus()->respond()->with($user->toArray());
    }

    /**
     * @throws UserNotCreated|UserNotFound
     */
    public function create(UserRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $user_id = directus()->databases()->system()->transaction(function () use ($attributes): string {
            /** @var User $user */
            $user = new User($attributes);
            $user->saveOrFail();

            return $user->id;
        });

        /** @var User $user */
        $user = User::with(['role', 'sessions', 'collectionPresets'])->findOrFail($user_id);

        return directus()->respond()->with($user->toArray());
    }

    /**
     * @throws RoleNotFound|UserNotFound
     */
    public function update(string $key, UserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::with(['role', 'sessions', 'collectionPresets'])->findOrFail($key);
        $user->update($request->all());

        return directus()->respond()->with($user->toArray());
    }

    /**
     * @throws UserNotFound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var User $user */
        $user = User::findOrFail($key);
        $user->delete();

        return directus()->respond()->withNothing();
    }

    // TODO: Missing https://docs.directus.io/api/users.html#retrieve-the-current-user

    /**
     * @throws UserNotCreated
     */
    public function invite(UserInviteRequest $request): JsonResponse
    {
        $attributes = [
            'email' => $request->get('email'),
            'status' => 'invited',
        ];

        return directus()->respond()->with(
            directus()->databases()->system()->transaction(function () use ($attributes): array {
                /** @var User $user */
                $user = new User($attributes);
                $user->saveOrFail();

                return $user->toArray();
            })
        );
    }

    public function acceptInvite(string $token): JsonResponse
    {
        // TODO
        return directus()->respond()->withNothing();
    }

    /**
     * @throws UserNotFound
     */
    public function updateLastPage(string $key, UserTrackingRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::findOrFail($key);
        $user->update([
            'last_page' => $request->get('last_page'),
            'last_access_on' => Carbon::now(),
        ]);

        return directus()->respond()->with($user->toArray());
    }

    public function revision(string $key, string $offset = null): JsonResponse
    {
        // TODO
        return directus()->respond()->withNothing();
    }
}
