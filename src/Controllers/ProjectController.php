<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Project controller.
 */
class ProjectController extends BaseController
{
    /**
     * Project information.
     */
    public function info(): JsonResponse
    {
        return directus()->respond()->with('oy');
    }
}
