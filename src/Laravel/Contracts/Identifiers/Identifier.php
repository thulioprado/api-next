<?php

declare(strict_types=1);

namespace Directus\Laravel\Contracts\Identifiers;

interface Identifier
{
    public function identified(): bool;

    public function identify(): bool;

    public function get(): string;

    public function switch(string $project): void;
}
