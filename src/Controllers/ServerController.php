<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Server controller.
 */
class ServerController extends BaseController
{
    public function info(): JsonResponse
    {
        return directus()->respond()->withQuery(
            directus()->graphql()->server()->execute('
                query {
                    info {
                        directus {
                            version
                            extensions
                        }
                        environment {
                            name
                            server
                            container
                            os
                        }
                        php {
                            arch
                            version
                            settings
                            extensions
                        }
                    }
                }
            ')
        );
    }

    // TODO: implement a "compatibility check", to check server settings, extensions, php version,
    //       upload size (if project config is lower or qual the php ini value, etc)

    public function ping(): JsonResponse
    {
        return directus()->respond()->public()->withQuery(
            directus()->graphql()->server()->execute('
                query {
                    ping
                }
            ')
        );
    }

    public function projects(): JsonResponse
    {
        // TODO: dynamic load of projects
        return directus()->respond()->public()->withQuery(
            directus()->graphql()->server()->execute('
                query {
                    projects {
                        id
                    }
                }
            ')
        );
    }

    /**
     * @throws NotImplemented
     */
    public function createProject(): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws NotImplemented
     */
    public function deleteProject(string $key): JsonResponse
    {
        throw new NotImplemented();
    }
}
