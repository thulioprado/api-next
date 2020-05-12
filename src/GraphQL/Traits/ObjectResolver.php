<?php

declare(strict_types=1);

namespace Directus\GraphQL\Traits;

trait ObjectResolver
{
    public function __construct()
    {
        parent::__construct($this->definition());
    }

    /**
     * Gets the type definition.
     */
    abstract protected function definition(): array;
}
