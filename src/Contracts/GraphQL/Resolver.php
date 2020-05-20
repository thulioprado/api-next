<?php

declare(strict_types=1);

namespace Directus\Contracts\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;

interface Resolver
{
    /**
     * @param mixed $parent
     * @param array $arguments
     * @param Context $context
     * @param ResolveInfo $info
     * @return mixed
     */
    public static function resolve($parent, $arguments, Context $context, ResolveInfo $info);
}
