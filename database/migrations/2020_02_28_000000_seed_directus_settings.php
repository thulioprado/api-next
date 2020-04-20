<?php

declare(strict_types=1);

use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;

class SeedDirectusSettings extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->collection('settings')->builder()->insert([
            [
                'key' => 'project_name',
                'value' => json_encode('Directus'),
            ],
            [
                'key' => 'project_url',
                'value' => json_encode(null),
            ],
            [
                'key' => 'project_logo',
                'value' => json_encode(null),
            ],
            [
                'key' => 'project_color',
                'value' => json_encode('#263238'),
            ],
            [
                'key' => 'project_foreground',
                'value' => json_encode(null),
            ],
            [
                'key' => 'project_background',
                'value' => json_encode(null),
            ],
            [
                'key' => 'project_public_note',
                'value' => json_encode(''),
            ],
            [
                'key' => 'default_locale',
                'value' => null,
            ],
            [
                'key' => 'telemetry',
                'value' => json_encode(true),
            ],
            [
                'key' => 'default_limit',
                'value' => json_encode('200'),
            ],
            [
                'key' => 'sort_null_last',
                'value' => json_encode(true),
            ],
            [
                'key' => 'password_policy',
                'value' => json_encode(''),
            ],
            [
                'key' => 'auto_sign_out',
                'value' => json_encode('10080'),
            ],
            [
                'key' => 'login_attempts_allowed',
                'value' => json_encode('25'),
            ],
            [
                'key' => 'auth_token_ttl',
                'value' => json_encode('20'),
            ],
            [
                'key' => 'trusted_proxies',
                'value' => json_encode([]),
            ],
            [
                'key' => 'file_mimetype_whitelist',
                'value' => json_encode([]),
            ],
            [
                'key' => 'file_naming',
                'value' => json_encode('uuid'),
            ],
            [
                'key' => 'asset_url_naming',
                'value' => json_encode('private_hash'),
            ],
            [
                'key' => 'youtube_api_key',
                'value' => json_encode(null),
            ],
            [
                'key' => 'asset_whitelist',
                'value' => json_encode([
                    [
                        'key' => 'thumbnail',
                        'width' => 200,
                        'height' => 200,
                        'fit' => 'contain',
                        'quality' => 80,
                    ],
                ]),
            ],
            [
                'key' => 'asset_whitelist_system',
                'value' => json_encode([
                    [
                        'key' => 'directus-small-crop',
                        'width' => 64,
                        'height' => 64,
                        'fit' => 'crop',
                        'quality' => 80,
                    ],
                    [
                        'key' => 'directus-small-contain',
                        'width' => 64,
                        'height' => 64,
                        'fit' => 'contain',
                        'quality' => 80,
                    ],
                    [
                        'key' => 'directus-medium-crop',
                        'width' => 300,
                        'height' => 300,
                        'fit' => 'crop',
                        'quality' => 80,
                    ],
                    [
                        'key' => 'directus-medium-contain',
                        'width' => 300,
                        'height' => 300,
                        'fit' => 'contain',
                        'quality' => 80,
                    ],
                    [
                        'key' => 'directus-large-crop',
                        'width' => 800,
                        'height' => 600,
                        'fit' => 'crop',
                        'quality' => 80,
                    ],
                    [
                        'key' => 'directus-large-contain',
                        'width' => 800,
                        'height' => 600,
                        'fit' => 'contain',
                        'quality' => 80,
                    ],
                ]),
            ],
        ]);
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $system = Directus::databases()->system();

        $system->collection('settings')->truncate();
    }
}
