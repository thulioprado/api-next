<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types;

use GraphQL\Executor\Executor;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Str;

abstract class Type extends ObjectType
{
    /**
     * Type constructor.
     */
    public function __construct(array $config = [])
    {
        parent::__construct(array_merge($this->definition(), $config));
    }

    /**
     * The type definition.
     */
    protected function definition(): array
    {
        return [
            'name' => $this->name(),
            'description' => $this->description(),
            'fields' => $this->fields(),
            'resolveField' => function ($value, $arguments, $context, ResolveInfo $info) {
                $method = 'resolve'.Str::ucfirst(Str::camel($info->fieldName));
                if (method_exists($this, $method)) {
                    $resolver = [$this, $method];
                    if (is_callable($resolver)) {
                        return $resolver($value, $arguments, $context, $info);
                    }
                }

                return Executor::getDefaultFieldResolver()($value, $arguments, $context, $info);
            },
        ];
    }

    abstract protected function name(): string;

    abstract protected function description(): string;

    abstract protected function fields(): array;
}
