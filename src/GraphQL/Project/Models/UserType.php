<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class UserType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'User',
            'description' => 'Directus user information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique user id.',
                ],
                'role_id' => [
                    'type' => Types::string(),
                    'description' => 'Unique identifier of the role of this user.',
                ],
                'first_name' => [
                    'type' => Types::string(),
                    'description' => 'First name of the user.',
                ],
                'last_name' => [
                    'type' => Types::string(),
                    'description' => 'Last name of the user.',
                ],
                'email' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique email address for the user.',
                ],
                'password' => [
                    'type' => Types::string(),
                    'description' => 'Password for the new user.',
                ],
                'status' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'One of active, invited, draft, suspended, deleted.',
                ],
                'last_access_on' => [
                    'type' => Types::string(),
                    'description' => 'When this user logged in last.',
                ],
                'last_page' => [
                    'type' => Types::string(),
                    'description' => 'Last page that the user was on.',
                ],
                'external_id' => [
                    'type' => Types::string(),
                    'description' => 'ID used for SCIM.',
                ],
                'theme' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'What theme the user is using. One of light, dark, or auto.',
                ],
                'twofactor_secret' => [
                    'type' => Types::string(),
                    'description' => 'The 2FA secret string that\'s used to generate one time passwords.',
                ],
                'password_reset_token' => [
                    'type' => Types::string(),
                    'description' => 'If the users requests a password reset, this token will be sent in an email.',
                ],
                'timezone' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'The user\'s timezone.',
                ],
                'locale' => [
                    'type' => Types::string(),
                    'description' => 'The user\'s locale used in Directus.',
                ],
                'locale_options' => [
                    'type' => Types::string(),
                    'description' => 'Not currently used. Can be used in the future to allow language overrides like different date formats for locales.',
                ],
                'avatar_id' => [
                    'type' => Types::string(),
                    'description' => 'The user\'s avatar.',
                ],
                'company' => [
                    'type' => Types::string(),
                    'description' => 'The user\'s company.',
                ],
                'title' => [
                    'type' => Types::string(),
                    'description' => 'The user\'s title.',
                ],
                'email_notifications' => [
                    'type' => Types::required(Types::boolean()),
                    'description' => 'Whether or not the user wants to receive notifications per email.',
                ],

                // TODO: relationships
            ],
        ]);
    }
}
