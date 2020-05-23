<?php

declare(strict_types=1);

namespace Directus\Contracts\GraphQL\Query;

use GraphQL\Executor\ExecutionResult;

interface MutationBuilder
{
    public function execute(array $arguments = []): ExecutionResult;
}
