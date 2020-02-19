<?php

declare(strict_types=1);

namespace Directus\Laravel\Projects\Identifier;

/**
 * Identification interface.
 */
interface ResolverInterface
{
    /**
     * Check if project has been identified.
     */
    public function isIdentified(): bool;

    /**
     * Identify the working project name.
     */
    public function identify(): bool;

    /**
     * Gets the identified project.
     */
    public function getIdentified(): ?string;
}
