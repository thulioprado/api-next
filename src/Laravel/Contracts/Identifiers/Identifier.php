<?php

declare(strict_types=1);

namespace Directus\Laravel\Contracts\Identifiers;

/**
 * Identifier interface.
 */
interface Identifier
{
    /**
     * Checks if project has been identified.
     */
    public function identified(): bool;

    /**
     * Identifies a project.
     */
    public function identify(): bool;

    /**
     * Gets the identified project.
     */
    public function get(): ?string;

    /**
     * Switches the current identified project.
     */
    public function switch(string $project): void;
}
