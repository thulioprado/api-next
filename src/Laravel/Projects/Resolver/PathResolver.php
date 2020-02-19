<?php

declare(strict_types=1);

namespace Directus\Laravel\Projects\Identifier;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Identification interface.
 */
class PathResolver implements ResolverInterface
{
    /**
     * Project parameter.
     */
    private const PROJECT_PARAM = 'project';

    /**
     * Is project identified.
     *
     * @var bool
     */
    private $identified = false;

    /**
     * Project name.
     *
     * @var null|string
     */
    private $project;

    /**
     * Path identifier.
     */
    public function __construct()
    {
        $this->identified = false;
        $this->project = null;
    }

    /**
     * {@inheritdoc}
     */
    public function isIdentified(): bool
    {
        return $this->identified;
    }

    /**
     * Gets the identified project name.
     *
     * @return string
     */
    public function getIdentified(): ?string
    {
        return $this->project;
    }

    /**
     * {@inheritdoc}
     */
    public function identify(): bool
    {
        if ($this->isIdentified()) {
            return true;
        }

        /** @var Request */
        $request = resolve(Request::class);

        /** @var Route */
        $route = $request->route();

        $parameters = $route->parameters();
        if (!\array_key_exists(self::PROJECT_PARAM, $parameters)) {
            return false;
        }

        $this->identified = true;
        $this->project = $parameters[self::PROJECT_PARAM];

        $route->forgetParameter(self::PROJECT_PARAM);

        return true;
    }
}
