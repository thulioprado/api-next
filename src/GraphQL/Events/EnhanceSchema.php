<?php

declare(strict_types=1);

namespace Directus\GraphQL\Events;

class EnhanceSchema
{
    /**
     * @var string
     */
    public $source;

    /**
     * SourceLoaded constructor.
     */
    public function __construct(string $source)
    {
        $this->source = $source;
    }
}
