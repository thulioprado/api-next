<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Setting;
use Illuminate\Http\JsonResponse;

/**
 * Project controller.
 */
class ProjectController extends BaseController
{
    /**
     * Project information.
     */
    public function info(): JsonResponse
    {
        // TODO: split this response into composeable plugins/hooks/extensions
        return directus()->respond()->with([
            // TODO: this would be a better place and makes more sense
            'name' => Setting::fromKey('project_name'),
            'url' => Setting::fromKey('project_url'),
            'public_note' => Setting::fromKey('project_public_note'),
            'logo' => Setting::fromKey('project_logo'),
            'color' => Setting::fromKey('project_color'),
            'files' => [
                'foreground' => Setting::fromKey('project_foreground'),
                'background' => Setting::fromKey('project_background'),
            ],
            'telemetry' => Setting::fromKey('telemetry'),
            'default_locale' => Setting::fromKey('default_locale'),
            // ENDTODO

            // TODO: remove this block later
            'api' => [
                'version' => directus()->version(),
                // TODO: shouldn't requires2FA go to /me?
                // TODO: implement requires2FA
                'requires2FA' => false,
                'database' => [
                    'user' => directus()->databases()->database()->driver(),
                    'system' => directus()->databases()->system()->driver(),
                ],
                // TODO: better structure this, separate to 'settings' key outside 'api'
                'project_name' => Setting::fromKey('project_name'),
                'project_logo' => Setting::fromKey('project_logo'),
                'project_color' => Setting::fromKey('project_color'),
                'project_foreground' => Setting::fromKey('project_foreground'),
                'project_background' => Setting::fromKey('project_background'),
                'telemetry' => Setting::fromKey('telemetry'),
                'default_locale' => Setting::fromKey('default_locale'),
                'project_public_note' => Setting::fromKey('project_public_note'),
                // ENDTODO
            ],

            // TODO: rethink if this is needed in this context (redundant with /server/info)
            'server' => [
                'max_upload_size' => ini_get('max_upload_size'),
                // TODO: admin only
                'general' => [
                    'php_version' => PHP_VERSION,
                    'php_api' => \defined('PHP_SAPI') ? \PHP_SAPI : 'unknown',
                ],
            ],
        ]);
    }
}
