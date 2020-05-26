<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Module controller.
 */
class ModuleController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function modules(): JsonResponse
    {
        throw new NotImplemented();
    }
}
