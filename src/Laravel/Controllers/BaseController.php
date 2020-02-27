<?php

declare(strict_types=1);

namespace Directus\Laravel\Controllers;

use Illuminate\Routing\Controller;

/**
 * Server controller.
 */
abstract class BaseController extends Controller
{
    public function __construct()
    {
    }
}
