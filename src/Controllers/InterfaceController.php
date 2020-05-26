<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Interface controller.
 */
class InterfaceController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function interfaces(): JsonResponse
    {
        throw new NotImplemented();
    }
}
