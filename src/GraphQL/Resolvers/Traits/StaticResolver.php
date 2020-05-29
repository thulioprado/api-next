<?php

declare(strict_types=1);

namespace Directus\GraphQL\Resolvers\Traits;

use Directus\Contracts\GraphQL\Context;
use GraphQL\Type\Definition\ResolveInfo;
use RuntimeException;
use Illuminate\Support\Str;

trait StaticResolver
{
    public static function resolve($parent, $arguments, Context $context, ResolveInfo $info)
    {
        $method = 'resolve'.Str::studly($info->fieldName);
        if (method_exists(static::class, $method)) {
            return static::$method($parent, $arguments, $context, $info);
        }

        throw new RuntimeException("No resolver found for field \"{$info->fieldName}\" in type \"{$info->parentType->name}\"");
    }
}
