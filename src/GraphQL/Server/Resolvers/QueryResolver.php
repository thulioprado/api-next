<?php

declare(strict_types=1);

namespace Directus\GraphQL\Server\Resolvers;

use Directus\Contracts\GraphQL\Context;
use Directus\Contracts\GraphQL\Resolver;
use GraphQL\Type\Definition\ResolveInfo;

class QueryResolver implements Resolver
{
    public static function resolve($parent, $arguments, Context $context, ResolveInfo $info)
    {
        return [
        ];
    }
}
