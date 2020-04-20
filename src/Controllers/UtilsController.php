<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Utils controller.
 */
class UtilsController extends BaseController
{
    /**
     * Random string generator.
     */
    public function randomString(Request $request): JsonResponse
    {
        $request->validate([
            'length' => 'integer|min:1|max:128',
        ]);

        return directus()->respond()->with([
            'random' => Str::random($request->input('length', 32)),
        ]);
    }

    /**
     * Hash computer.
     */
    public function hashCreate(Request $request): JsonResponse
    {
        $request->validate([
            'string' => 'required|string',
        ]);

        return directus()->respond()->with([
            'hash' => Hash::make($request->input('string')),
        ]);
    }

    /**
     * Hash verifier.
     */
    public function hashVerify(Request $request): JsonResponse
    {
        $request->validate([
            'string' => 'required|string',
            'hash' => 'required|string',
        ]);

        return directus()->respond()->with([
            'valid' => Hash::check(
                $request->input('string'),
                $request->input('hash'),
            ),
        ]);
    }
}
