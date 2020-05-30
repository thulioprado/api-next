<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers;

use Directus\GraphQL\Project\Resolvers\Setting\SettingMutation;
use Directus\GraphQL\Project\Resolvers\User\UserMutation;

class MutationResolver
{
    use SettingMutation, UserMutation;
}
