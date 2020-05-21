<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Plugins\Builtin\Compat\Contracts\Transformer;
use Directus\Responses\Response;

class PingTransformer implements Transformer
{
    public static function transform(Response $response): void
    {
        $response->type('text/plain')->raw($response->get('data.ping'));
    }
}
