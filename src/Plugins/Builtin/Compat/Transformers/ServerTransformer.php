<?php

declare(strict_types=1);

namespace Directus\Plugins\Builtin\Compat\Transformers;

use Directus\Responses\Response;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;

class ServerTransformer
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('directus.request.route.server.info', [$this, 'infoRequest']);
        $events->listen('directus.response.route.server.info', [$this, 'infoResponse']);
        $events->listen('directus.request.route.server.ping', [$this, 'pingRequest']);
        $events->listen('directus.response.route.server.ping', [$this, 'pingResponse']);
        $events->listen('directus.request.route.server.projects.all', [$this, 'listProjectsRequest']);
        $events->listen('directus.response.route.server.projects.all', [$this, 'listProjectsResponse']);
    }

    public function infoRequest(Request $request): void
    {
    }

    public function infoResponse(Response $response): void
    {
        $response->set('data', $response->get('data.info'));
    }

    public function pingRequest(Request $request): void
    {
    }

    public function pingResponse(Response $response): void
    {
        $teste = request()->get('abobrinha', null);

        $response->type('text/plain')->raw($response->get('data.ping').' com '.$teste);
    }

    public function listProjectsRequest(Request $request): void
    {
    }

    public function listProjectsResponse(Response $response): void
    {
        $response->set('data', $response->get('data.projects'));
    }
}
