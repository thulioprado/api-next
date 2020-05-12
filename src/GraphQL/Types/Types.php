<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types;

use Directus\GraphQL\Types\Scalars\JsonType;
use GraphQL\Type\Definition\BooleanType;
use GraphQL\Type\Definition\FloatType;
use GraphQL\Type\Definition\IntType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\NullableType;
use GraphQL\Type\Definition\StringType;
use GraphQL\Type\Definition\Type;

class Types
{
    /**
     * @var array<string, array>
     */
    private static $cache = [];

    /**
     * @param array<int, mixed> $args
     *
     * @return mixed
     */
    public static function from(string $type, ...$args)
    {
        return static::$cache[$type] = static::$cache[$type] ?? new $type(...$args);
    }

    public static function wrapped(string $type, array $config = []): array
    {
        return static::$cache[$type] = static::$cache[$type] ?? array_merge([
            'type' => new $type(),
        ], $config);
    }

    // Directus types

    public static function json(): JsonType
    {
        return static::from(JsonType::class);
    }

    // Builtin type aliases

    public static function boolean(): BooleanType
    {
        return Type::boolean();
    }

    public static function float(): FloatType
    {
        return Type::float();
    }

    public static function integer(): IntType
    {
        return Type::int();
    }

    public static function string(): StringType
    {
        return Type::string();
    }

    /**
     * @param callable|Type $type
     */
    public static function list($type): ListOfType
    {
        return new ListOfType($type);
    }

    /**
     * @param NullableType $type
     */
    public static function required($type): NonNull
    {
        return new NonNull($type);
    }
}
