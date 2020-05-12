<?php

declare(strict_types=1);

namespace Directus\GraphQL\Traits;

use Directus\Exceptions\GraphQLException;
use Illuminate\Support\Str;

trait LocalResolver
{
    public function __construct()
    {
        parent::__construct(array_merge($this->definition(), [
            'resolveField' => function ($value, $arguments, $context, $info) {
                $method = 'resolve'.Str::ucfirst(Str::camel($info->fieldName));
                if (method_exists($this, $method)) {
                    return $this->{$method}($value, $arguments, $context, $info);
                }

                throw new GraphQLException();
            },
        ]));
    }

    /**
     * Gets the type definition.
     */
    abstract protected function definition(): array;
}
