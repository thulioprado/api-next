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

    public const USER_NOT_FOUND = 'user_not_found';
    public const USER_NOT_CREATED = 'user_not_created';

    public const ROLE_NOT_FOUND = 'role_not_found';
    public const ROLE_NOT_CREATED = 'role_not_created';

    public const FOLDER_NOT_FOUND = 'folder_not_found';
    public const FOLDER_NOT_CREATED = 'folder_not_created';

    public const TABLE_NOT_FOUND = 'table_not_found';
    public const COLUMN_NOT_FOUND = 'column_not_found';

    public const PERMISSION_NOT_FOUND = 'permission_not_found';
    public const PERMISSION_NOT_CREATED = 'permission_not_created';

    public const REVISION_NOT_FOUND = 'revision_not_found';

    public const RELATION_NOT_FOUND = 'relation_not_found';
    public const RELATION_NOT_CREATED = 'relation_not_created';

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

        // User

        self::USER_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        self::USER_NOT_CREATED => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['first_name', 'last_name', 'email', 'role_id', 'status'],
        ],

        // Role

        self::ROLE_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        self::ROLE_NOT_CREATED => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['name'],
        ],

        // Folder

        self::FOLDER_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        self::FOLDER_NOT_CREATED => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['name'],
        ],

        // Inspection

        self::TABLE_NOT_FOUND => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['name'],
        ],

        self::COLUMN_NOT_FOUND => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['name'],
        ],

        // Permission

        self::PERMISSION_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        self::PERMISSION_NOT_CREATED => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['collection_id', 'role_id'],
        ],

        // Revision

        self::REVISION_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        // Relation

        self::RELATION_NOT_FOUND => [
            'status' => Response::HTTP_NOT_FOUND,
            'context' => ['id'],
        ],

        self::RELATION_NOT_CREATED => [
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'context' => ['field_many'],
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
