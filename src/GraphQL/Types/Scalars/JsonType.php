<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Scalars;

use Exception;
use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use GraphQL\Utils\Utils;
use Safe\Exceptions\JsonException;

class JsonType extends ScalarType
{
    /**
     * The description that is used for schema introspection.
     *
     * @var string
     */
    public $description = 'Can be any value, including objects.';

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * In the case of an invalid value this method must throw an Exception
     *
     * @param mixed $value
     *
     * @throws Error
     *
     * @return mixed
     */
    public function parseValue($value)
    {
        return $this->decodeJSON($value);
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * In the case of an invalid node or value this method must throw an Exception
     *
     * @param Node         $valueNode
     * @param null|mixed[] $variables
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        if (!property_exists($valueNode, 'value')) {
            throw new Error(
                'Can only parse literals that contain a value, got '.Utils::printSafeJson($valueNode)
            );
        }

        return $this->decodeJSON($valueNode->value);
    }

    /**
     * Try to decode a user-given value into JSON.
     *
     * @param mixed $value
     *
     * @throws Error
     *
     * @return mixed
     */
    protected function decodeJSON($value)
    {
        try {
            $parsed = \Safe\json_decode($value);
        } catch (JsonException $jsonException) {
            throw new Error(
                $jsonException->getMessage()
            );
        }

        return $parsed;
    }
}
