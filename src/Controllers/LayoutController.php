<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Layout controller.
 */
class LayoutController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function layouts(): JsonResponse
    {
        throw new NotImplemented();
    }
}
