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
    /**
     * Keys.
     */
    public const NOT_IMPLEMENTED = 'not_implemented';

    public const SETTING_NOT_FOUND = 'setting_not_found';
    public const SETTING_ALREADY_EXISTS = 'setting_already_exists';

    public const COLLECTION_NOT_FOUND = 'collection_not_found';
    public const COLLECTION_ALREADY_EXISTS = 'collection_already_exists';

    public const ACTIVITY_NOT_FOUND = 'activity_not_found';
    public const PRESET_NOT_FOUND = 'preset_not_found';

    /**
     * @var array
     */
    protected static $errors = [
        // General

        self::NOT_IMPLEMENTED => [
            'status' => Response::HTTP_NOT_IMPLEMENTED,
            'context' => ['method'],
        ],

        // Settings

        self::SETTING_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['key'],
        ],
        self::SETTING_ALREADY_EXISTS => [
            'status' => Response::HTTP_CONFLICT,
            'context' => ['key'],
        ],

        // Collection

        self::COLLECTION_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['key'],
        ],
        self::COLLECTION_ALREADY_EXISTS => [
            'status' => Response::HTTP_CONFLICT,
            'context' => ['key'],
        ],

        // Activity

        self::ACTIVITY_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        // Preset

        self::PRESET_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
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
