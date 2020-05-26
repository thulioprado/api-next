<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Project controller.
 */
class ProjectController extends BaseController
{
    /**
     * @throws notImplemented
     */
    public function info(): JsonResponse
    {
        throw new NotImplemented();
    }

    /**
     * @throws notImplemented
     */
    public function update(): JsonResponse
    {
        throw new NotImplemented();
    }
}
