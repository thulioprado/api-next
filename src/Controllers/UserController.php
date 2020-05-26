<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * User controller.
 */
class UserController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query {
                    users {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function fetch(string $key): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query User($id: String!) {
                    user(id: $id) {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function create(): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation CreateUser(
                    $status: String!,
                    $role_id: String!,
                    $first_name: String!,
                    $last_name: String!,
                    $email: String!,
                    $password: String!,
                    $last_access_on: DateTime,
                    $last_page: Int,
                    $external_id: String,
                    $theme: String,
                    $twofactor_secret: String,
                    $password_reset_token: String,
                    $timezone: String,
                    $locale: String,
                    $locale_options: String,
                    $avatar_id: String,
                    $company: String,
                    $title: String,
                    $email_notifications: Boolean
                ) {
                    createUser(
                        status: $status,
                        role_id: $role_id,
                        first_name: $first_name,
                        last_name: $last_name,
                        email: $email,
                        password: $password,
                        last_access_on: $last_access_on,
                        last_page: $last_page,
                        external_id: $external_id,
                        theme: $theme,
                        twofactor_secret: $twofactor_secret,
                        password_reset_token: $password_reset_token,
                        timezone: $timezone,
                        locale: $locale,
                        locale_options: $locale_options,
                        avatar_id: $avatar_id,
                        company: $company,
                        title: $title,
                        email_notifications: $email_notifications
                    ) {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function update(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = array_merge(request()->all(), [
            'id' => $key,
        ]);

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation UpdateUser(
                    $status: String!,
                    $role_id: String!,
                    $first_name: String!,
                    $last_name: String!,
                    $email: String!,
                    $password: String!,
                    $last_access_on: DateTime,
                    $last_page: Int,
                    $external_id: String,
                    $theme: String,
                    $twofactor_secret: String,
                    $password_reset_token: String,
                    $timezone: String,
                    $locale: String,
                    $locale_options: String,
                    $avatar_id: String,
                    $company: String,
                    $title: String,
                    $email_notifications: Boolean
                ) {
                    updateUser(
                        status: $status,
                        role_id: $role_id,
                        first_name: $first_name,
                        last_name: $last_name,
                        email: $email,
                        password: $password,
                        last_access_on: $last_access_on,
                        last_page: $last_page,
                        external_id: $external_id,
                        theme: $theme,
                        twofactor_secret: $twofactor_secret,
                        password_reset_token: $password_reset_token,
                        timezone: $timezone,
                        locale: $locale,
                        locale_options: $locale_options,
                        avatar_id: $avatar_id,
                        company: $company,
                        title: $title,
                        email_notifications: $email_notifications
                    ) {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function delete(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation DeleteUser($id: String!) {
                    deleteUser(id: $id) {
                        id
                    }
                }
            ', $fields)
        );
    }

    /**
     * @throws NotImplemented
     */
    public function current(): JsonResponse
    {
        throw new NotImplemented();
    }

    public function invite(string $token = null): JsonResponse
    {
        $project = config('directus.project.id', 'api');

        if ($token !== null) {
            $fields = [
                'token' => $token,
            ];

            return directus()->respond()->withQuery(
                directus()->graphql()->project($project)->execute('
                    mutation AcceptInviteUser($token: String!) {
                        acceptInviteUser(token: $token) {
                            id
                            status
                            role_id
                            first_name
                            last_name
                            email
                            token
                            last_access_on
                            last_page
                            external_id
                            theme
                            twofactor_secret
                            password_reset_token
                            timezone
                            locale
                            locale_options
                            avatar_id
                            company
                            title
                            email_notifications
                        }
                    }
                ', $fields)
            );
        }

        $fields = request()->all();

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation InviteUser($email: String!) {
                    inviteUser(email: $email) {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function updateLastPage(string $key): JsonResponse
    {
        $project = config('directus.project.id', 'api');
        $fields = [
            'id' => $key,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                mutation UpdateLastPageUser($id: String!, $last_page: String!) {
                    updateLastPageUser(id: $id, last_page: $last_page) {
                        id
                        status
                        role_id
                        first_name
                        last_name
                        email
                        token
                        last_access_on
                        last_page
                        external_id
                        theme
                        twofactor_secret
                        password_reset_token
                        timezone
                        locale
                        locale_options
                        avatar_id
                        company
                        title
                        email_notifications
                    }
                }
            ', $fields)
        );
    }

    public function revisions(string $key, string $offset = null): JsonResponse
    {
        // TODO: query filters

        $project = config('directus.project.id', 'api');
        $fields = [
            'item' => $key,
            'offset' => $offset,
        ];

        return directus()->respond()->withQuery(
            directus()->graphql()->project($project)->execute('
                query Revisions($item: String!, $offset: Int) {
                    revisions(item: $item, offset: $offset) {
                        id
                        activity_id
                        collection_id
                        item
                        data
                        delta
                        parent_collection_id
                        parent_item
                        parent_changed
                    }
                }
            ', $fields)
        );
    }

    /**
     * @throws NotImplemented
     */
    public function activateTwoFactor(string $key, string $offset = null): JsonResponse
    {
        throw new NotImplemented();
    }
}
