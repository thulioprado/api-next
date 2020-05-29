<?php

declare(strict_types=1);

namespace Directus\GraphQL\Schema;

use GraphQL\Language\AST\DocumentNode;
use GraphQL\Language\AST\TypeDefinitionNode;
use GraphQL\Language\AST\TypeExtensionNode;
use GraphQL\Language\Parser;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Schema;
use GraphQL\Utils\BuildSchema;
use GraphQL\Utils\SchemaExtender;

class Builder
{
    public static function build(string $source, callable $resolve): Schema
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

        $schema = BuildSchema::build($document);

        $extended = SchemaExtender::extend($schema, new DocumentNode([
            'definitions' => $extensions,
        ]));

        foreach ($types as $typeName) {
            $type = $extended->getType($typeName);
            if ($type instanceof ObjectType) {
                static::applyResolversToFields($type, $resolve);
            }
        }

        return $extended;
    }

    private static function applyResolversToFields(ObjectType $type, callable $resolve) {
        foreach ($type->getFields() as $field) {
            $resolver = $resolve($type->name, $field->name);
            if ($resolver !== null) {
                $field->resolveFn = $resolver;
            }
        }
    }
}
