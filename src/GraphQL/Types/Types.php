<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types;

use Directus\GraphQL\Types\Scalars\JsonType;
use GraphQL\Language\AST\BooleanValueNode;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\NameNode;
use GraphQL\Language\AST\NonNullTypeNode;
use GraphQL\Language\AST\NullValueNode;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Language\AST\ValueNode;
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

    // Resolvers

    public static function resolver($class): callable
    {
        return [$class, 'resolve'];
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

    public static function typeToNode(Type $type)
    {
        if ($type instanceof NonNull) {
            return new NonNullTypeNode([
                'type' => static::typeToNode($type->getWrappedType()),
            ]);
        }
        if ($type instanceof ListOfType) {
            return new ListTypeNode([
                'type' => static::typeToNode($type->getWrappedType()),
            ]);
        }

        return new NamedTypeNode([
            'name' => new NameNode([
                'value' => $type->name,
            ]),
        ]);
    }

    public static function nodeFromValue($value): ValueNode
    {
        if (is_null($value)) {
            return new NullValueNode();
        }
        if (is_int($value)) {
            return new IntValueNode(['value' => $value]);
        }
        if (is_float($value)) {
            return new FloatValueNode(['value' => $value]);
        }
        if (is_string($value)) {
            return new StringValueNode(['value' => $value]);
        }
        if (is_bool($value)) {
            return new BooleanValueNode(['value' => $value]);
        }

        return new NullValueNode();
    }
}
