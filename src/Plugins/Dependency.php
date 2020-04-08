<?php

declare(strict_types=1);

namespace Directus\Plugins;

class Dependency implements \Directus\Contracts\Plugins\Dependency
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $optional;

    /**
     * Dependency constructor.
     */
    public function __construct(string $name, bool $optional)
    {
        $this->name = $name;
        $this->optional = $optional;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function optional(): bool
    {
        return $this->optional;
    }

    /**
     * {@inheritdoc}
     */
    public function required(): bool
    {
        return !$this->optional;
    }
}
