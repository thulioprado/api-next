<?php

declare(strict_types=1);

namespace Directus\GraphQL\Query;

use Directus\Contracts\GraphQL\Engine;
use Directus\Contracts\GraphQL\Query\QueryBuilder as QueryBuilderContract;
use Illuminate\Support\Traits\Macroable;

class QueryBuilder implements QueryBuilderContract
{
    use Macroable;

    /**
     * @var Engine
     */
    protected $engine;

    /**
     * Constructor.
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }
}
