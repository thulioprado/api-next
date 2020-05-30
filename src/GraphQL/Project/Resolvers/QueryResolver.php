<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Resolvers;

use Directus\GraphQL\Project\Resolvers\Setting\SettingQuery;
use Directus\GraphQL\Project\Resolvers\User\UserQuery;

class QueryResolver
{
    use SettingQuery, UserQuery;
}
