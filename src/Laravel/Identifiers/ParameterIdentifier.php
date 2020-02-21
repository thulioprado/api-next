<?php

declare(strict_types=1);

namespace Directus\Laravel\Identifiers;

use Directus\Framework\Directus;
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
    private const PROJECT_PARAMETER = 'project';

    /**
     * Collection parameter.
     */
    private const COLLECTION_PARAMETER = 'collection';

    /**
     * Is project identified.
     *
     * @var bool
     */
    private $_identified;

    /**
     * Project name.
     *
     * @var null|string
     */
    private $_project;

    /**
     * Project collection.
     *
     * @var null|string
     */
    private $_collection;

    /**
     * Path identifier.
     */
    public function __construct()
    {
        $this->_identified = false;
        $this->_project = null;
        $this->_collection = null;
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
    public function project(): ?string
    {
        return $this->_project;
    }

    /**
     * {@inheritdoc}
     */
    public function collection(): ?string
    {
        return $this->_collection;
    }

    /**
     * {@inheritdoc}
     */
    public function identify(): bool
    {
        if ($this->identified()) {
            return true;
        }

        /** @var Directus */
        $directus = resolve(Directus::class);

        /** @var Request */
        $request = resolve(Request::class);

        /** @var Route */
        $route = $request->route();

        $parameters = $route->parameters();

        if (!\array_key_exists(self::PROJECT_PARAMETER, $parameters)) {
            return false;
        }

        $this->_project = $parameters[self::PROJECT_PARAMETER];

        $project = $directus->projects()->project($this->_project);
        $route->setParameter(self::PROJECT_PARAMETER, $project);

        $this->_identified = true;

        if (\array_key_exists(self::COLLECTION_PARAMETER, $parameters)) {
            $this->_collection = $parameters[self::COLLECTION_PARAMETER];
            $route->setParameter(self::COLLECTION_PARAMETER, $project->collection($this->_collection));
        }

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
