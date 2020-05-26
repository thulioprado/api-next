<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Type controller.
 */
class TypeController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function types(): JsonResponse
    {
        throw new NotImplemented();
    }
}
