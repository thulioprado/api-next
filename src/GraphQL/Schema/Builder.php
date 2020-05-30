<?php

declare(strict_types=1);

namespace Directus\GraphQL\Schema;

use GraphQL\Language\AST\DocumentNode;
use GraphQL\Language\AST\ObjectTypeDefinitionNode;
use GraphQL\Language\AST\ScalarTypeDefinitionNode;
use GraphQL\Language\AST\TypeDefinitionNode;
use GraphQL\Language\AST\TypeExtensionNode;
use GraphQL\Language\Parser;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use GraphQL\Utils\SchemaExtender;

class Builder
{
    public static function build(string $source, callable $resolve, callable $scalar): Schema
    {
        /** @var DocumentNode $document */
        $document = Parser::parse($source, [
            'noLocation' => true,
        ]);

        $types = [];
        $extensions = [];

        foreach ($document->definitions as $key => $definition) {
            if ($definition instanceof TypeDefinitionNode) {
                $types[] = $definition->name->value;
            } elseif ($definition instanceof TypeExtensionNode) {
                $extensions[] = $document->definitions[$key];
                unset($document->definitions[$key]);
            }
        }

        $schema = BuildSchema::build(
            $document,
            static function ($config, $definition) use ($scalar) {
                if ($definition instanceof ScalarTypeDefinitionNode) {
                    $type = $scalar($definition->name->value);
                    if ($type !== null) {
                        $instance = new $type();
                        $config['serialize'] = [$instance, 'serialize'];
                        $config['parseValue'] = [$instance, 'parseValue'];
                        $config['parseLiteral'] = [$instance, 'parseLiteral'];
                    }
                }

                return $config;
            }
        );

        $extended = SchemaExtender::extend($schema, new DocumentNode([
            'definitions' => $extensions,
        ]));

        /*
        $extended = BuildSchema::build($extendedSource,
            function ($config, $definition) use ($resolve) {
                if ($definition instanceof ObjectTypeDefinitionNode) {
                    foreach ($definition->fields as $field) {
                        $resolver = $resolve($definition->name->value, $field->name->value);
                        if ($resolver !== null) {
                            $config['resolveField'] = $resolver;
                        }
                    }
                } elseif ($definition instanceof ScalarTypeDefinitionNode) {

                }
                return $config;
            }
        );
         * */

        foreach ($types as $typeName) {
            $type = $extended->getType($typeName);
            if ($type instanceof ObjectType) {
                static::applyResolversToFields($type, $resolve);
            } elseif ($type instanceof ScalarType) {
                $woow = true;
                //$extended->getType($typeName, )
            }
        }

        return $extended;
    }

    private static function applyResolversToFields(ObjectType $type, callable $resolve)
    {
        foreach ($type->getFields() as $field) {
            $resolver = $resolve($type->name, $field->name);
            if ($resolver !== null) {
                $field->resolveFn = $resolver;
            }
        }
    }
}
