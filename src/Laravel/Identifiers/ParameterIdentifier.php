<?php

declare(strict_types=1);

namespace Directus\Laravel\Identifiers;

use Directus\Laravel\Contracts\Identifiers\Identifier;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Identification interface.
 */
class ParameterIdentifier implements Identifier
{
    /**
     * Project parameter.
     */
    private const PROJECT_PATH_PARAM = 'project';

    /**
     * Is project identified.
     *
     * @var bool
     */
    private $_identified;

    /**
     * Project name.
     *
     * @var string|null
     */
    private $_project;

    /**
     * Path identifier.
     */
    public function __construct()
    {
        $this->_identified = false;
        $this->_project = null;
    }

    /**
     * {@inheritdoc}
     */
    public function identified(): bool
    {
        return $this->_identified;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): ?string
    {
        return $this->_project;
    }

    /**
     * {@inheritdoc}
     */
    public function identify(): bool
    {
        if ($this->identified()) {
            return true;
        }

        /** @var Request */
        $request = resolve(Request::class);

        /** @var Route */
        $route = $request->route();

        $parameters = $route->parameters();
        if (!\array_key_exists(self::PROJECT_PATH_PARAM, $parameters)) {
            return false;
        }

        $this->_identified = true;
        $this->_project = $parameters[self::PROJECT_PATH_PARAM];

        // We don't need to propagate this parameter
        $request->route()->forgetParameter('project');

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function switch(string $project): void
    {
        $this->_project = $project;
    }
}
