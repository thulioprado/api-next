<?php

declare(strict_types=1);

namespace Directus\Events;

use Directus\Responses\Response;

class Responding
{
    /**
     * @var Response
     */
    public $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
