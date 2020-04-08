<?php

declare(strict_types=1);

namespace Directus\Responses;

use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DirectusResponse.
 */
class Errors
{
    public const NOT_IMPLEMENTED = 'not_implemented';
    public const SETTING_NOT_FOUND = 'setting_not_found';
    public const SETTING_ALREADY_EXISTS = 'setting_already_exists';

    /**
     * @var array
     */
    protected static $errors = [
        self::SETTING_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['key'],
        ],
        self::SETTING_ALREADY_EXISTS => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['key'],
        ],
        self::NOT_IMPLEMENTED => [
            'status' => Response::HTTP_NOT_IMPLEMENTED,
            'context' => ['method'],
        ],
    ];

    /**
     * Gets error information from the error code.
     */
    public static function for(string $code, array $context = []): array
    {
        $error = static::$errors[$code] ?? [];
        $status = $error['status'] ?? 500;
        $fields = $error['context'] ?? [];
        $context = Arr::only($context, $fields);

        return [
            'code' => $code,
            'status' => $status,
            'message' => trans("directus::errors.{$code}", $context),
            'context' => $context,
        ];
    }
}
