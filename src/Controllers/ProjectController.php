<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Services\Settings\SettingsService;
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
        /** @var SettingsService $settings */
        $settings = directus()->settings();

        // TODO: split this response into composeable plugins/hooks/extensions
        return directus()->respond()->with([
            // TODO: this would be a better place and makes more sense
            'name' => $settings->get('project_name'),
            'url' => $settings->get('project_url'),
            'public_note' => $settings->get('project_public_note'),
            'logo' => $settings->get('project_logo'),
            'color' => $settings->get('project_color'),
            'files' => [
                'foreground' => $settings->get('project_foreground'),
                'background' => $settings->get('project_background'),
            ],
            'telemetry' => $settings->get('telemetry'),
            'default_locale' => $settings->get('default_locale'),
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
                'project_name' => $settings->get('project_name'),
                'project_logo' => $settings->get('project_logo'),
                'project_color' => $settings->get('project_color'),
                'project_foreground' => $settings->get('project_foreground'),
                'project_background' => $settings->get('project_background'),
                'telemetry' => $settings->get('telemetry'),
                'default_locale' => $settings->get('default_locale'),
                'project_public_note' => $settings->get('project_public_note'),
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
