<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Exceptions\NotImplemented;
use Illuminate\Http\JsonResponse;

/**
 * Mail controller.
 */
class MailController extends BaseController
{
    /**
     * @throws NotImplemented
     */
    public function send(): JsonResponse
    {
        throw new NotImplemented();
    }
}
