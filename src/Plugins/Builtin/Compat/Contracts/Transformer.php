<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Contracts;

use Directus\Responses\Response;

interface Transformer
{
    public static function transform(Response $response): void;
}
