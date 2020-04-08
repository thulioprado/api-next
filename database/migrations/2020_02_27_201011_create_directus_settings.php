<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusSettings extends Migration
{
    use MigrateFields;
    use
        MigrateCollections;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('settings')->name(),
            function (Blueprint $collection) {
                //$collection->uuid('id')->primary();
                $collection->string('key')->primary();
                $collection->json('value')->nullable();
            }
        );

        $this->registerCollection('ce5e5fd4-2a21-49da-ba6f-ceff799f35d4', 'settings');

        $this->registerField(
            $this->createField('7277ae62-ae89-4400-b131-7a4fc978efb9')
                ->on('settings')
                ->name('project_name')
                ->string()
                ->textInputInterface([
                    'iconRight' => 'title',
                ])
                ->required()
                ->note('Logo in the top-left of the App (40x40)')
        );

        $this->registerField(
            $this->createField('6d34f9b6-f7ed-4129-89c1-c962df89cbb0')
                ->on('settings')
                ->name('project_url')
                ->string()
                ->textInputInterface([
                    'iconRight' => 'link',
                ])
                ->note('External link for the App\'s top-left logo')
        );

        $this->registerField(
            $this->createField('5dcf7ef6-1efe-4bdb-a109-f23f0995a364')
                ->on('settings')
                ->name('project_logo')
                ->file()
                ->note('A 40x40 brand logo, ideally a white SVG/PNG')
                ->fileInterface()
        );

        $this->registerField(
            $this->createField('7f06d196-2b2c-42c6-a828-3e3ade2d638a')
                ->on('settings')
                ->name('project_color')
                ->string()
                ->note('Color for login background and App\'s logo')
                ->colorInterface()
        );

        $this->registerField(
            $this->createField('89af1eb5-eb83-4e9a-987a-f63da01ab68a')
                ->on('settings')
                ->name('project_foreground')
                ->file()
                ->note('Centered image (eg: logo) for the login page')
                ->fileInterface()
        );

        $this->registerField(
            $this->createField('e75393b9-a814-4922-b482-38ac0739c66c')
                ->on('settings')
                ->name('project_background')
                ->file()
                ->note('Full-screen background for the login page')
                ->fileInterface()
        );

        $this->registerField(
            $this->createField('2adcefeb-4f07-4b3d-809a-350cac90b6fd')
                ->on('settings')
                ->name('project_public_note')
                ->string()
                ->note('This value will be shown on the public pages of the app')
                ->markdownInterface()
        );

        $this->registerField(
            $this->createField('f2cd1723-6307-4d95-af6f-5a2746416b59')
                ->on('settings')
                ->name('default_locale')
                ->string()
                ->note('Default locale for Directus Users')
                ->languageInterface([
                    'limit' => true,
                ])
        );

        $this->registerField(
            $this->createField('e46d857c-4f91-4275-850e-dac54067583c')
                ->on('settings')
                ->name('telemetry')
                ->boolean()
                ->note('<a href="https://docs.directus.io/getting-started/concepts.html#telemetry" target="_blank">Learn More</a>')
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('813bf825-d51c-4fed-be62-c9e593c841c0')
                ->on('settings')
                ->name('data_divider')
                ->alias()
                ->dividerInterface([
                    'style' => 'large',
                    'title' => 'Data',
                    'hr' => true,
                ])
                ->hidden_browse()
        );

        $this->registerField(
            $this->createField('3e296394-6c4c-469f-8930-bc3899d65781')
                ->on('settings')
                ->name('default_limit')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'keyboard_tab',
                ])
                ->required()
                ->note('Default item count in API and App responses')
        );

        $this->registerField(
            $this->createField('6200a933-739e-4075-a60f-17854e8967ad')
                ->on('settings')
                ->name('sort_null_last')
                ->boolean()
                ->note('NULL values are sorted last')
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('c9ed8cd1-9332-4822-9da9-a8467bf0b1bc')
                ->on('settings')
                ->name('security_divider')
                ->alias()
                ->dividerInterface([
                    'style' => 'large',
                    'title' => 'Security',
                    'hr' => true,
                ])
                ->hidden_browse()
        );

        $this->registerField(
            $this->createField('8e4ec941-fa92-4deb-b4da-85ec01d4b201')
                ->on('settings')
                ->name('auto_sign_out')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'timer',
                ])
                ->required()
                ->note('Minutes before idle users are signed out')
        );

        $this->registerField(
            $this->createField('15a62bce-5251-4e4d-b5cf-9854486f3d2a')
                ->on('settings')
                ->name('login_attempts_allowed')
                ->integer()
                ->numericInterface([
                    'iconRight' => 'lock',
                ])
                ->note('Failed login attempts before suspending users')
        );

        $this->registerField(
            $this->createField('b8d55191-3bdf-4c90-a03e-8de4298fde21')
                ->on('settings')
                ->name('password_policy')
                ->string()
                ->note('Weak: Minimum length 8; Strong: 1 small-case letter, 1 capital letter, 1 digit, 1 special character and the length should be minimum 8')
                ->dropdownInterface([
                    'choices' => [
                        '' => 'None',
                        '/^.{8,}$/' => 'Weak',
                        '/(?=^.{8,}$)(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+}{\';\'?>.<,])(?!.*\\s).*$/' => 'Strong',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('2f7cfc26-c3c4-44a3-8e76-9e056446d958')
                ->on('settings')
                ->name('files_divider')
                ->alias()
                ->dividerInterface([
                    'style' => 'large',
                    'title' => 'Files & Thumbnails',
                    'hr' => true,
                ])
                ->hidden_browse()
        );

        $this->registerField(
            $this->createField('f39cd9d6-5972-4371-bc3b-554e679e9abb')
                ->on('settings')
                ->name('file_naming')
                ->string()
                ->note('File-system naming convention for uploads')
                ->dropdownInterface([
                    'choices' => [
                        'uuid' => 'UUID (Obfuscated)',
                        'file_name' => 'File Name (Readable)',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('742ff40f-3726-4ee9-88a3-0c93881826b1')
                ->on('settings')
                ->name('asset_url_naming')
                ->string()
                ->note('Thumbnail URL convention')
                ->dropdownInterface([
                    'choices' => [
                        'private_hash' => 'Private Hash (Obfuscated)',
                        'filename_download' => 'File Name (Readable)',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('a2d70f76-d7e4-4913-852b-d7ab8e09eea0')
                ->on('settings')
                ->name('file_mimetype_whitelist')
                ->array()
                ->tagsInterface([
                    'placeholder' => 'Enter a file mimetype then hit enter (eg: image/jpeg)',
                ])
                ->note('Enter a file mimetype then hit enter (eg: image/jpeg)')
        );

        $this->registerField(
            $this->createField('e56cca8a-af56-4784-b72d-5b470d70d9f8')
                ->on('settings')
                ->name('asset_whitelist')
                ->json()
                ->note('Defines how the thumbnail will be generated based on the requested params.')
                ->repeaterInterface([
                    'template' => '{{key}}',
                    'fields' => [
                        [
                            'field' => 'key',
                            'interface' => 'slug',
                            'width' => 'half',
                            'type' => 'string',
                            'required' => true,
                            'options' => [
                                'onlyOnCreate' => false,
                            ],
                        ],
                        [
                            'field' => 'fit',
                            'interface' => 'dropdown',
                            'width' => 'half',
                            'type' => 'string',
                            'options' => [
                                'choices' => [
                                    'crop' => 'Crop (forces exact size)',
                                    'contain' => 'Contain (preserve aspect ratio)',
                                ],
                            ],
                            'required' => true,
                        ],
                        [
                            'field' => 'width',
                            'interface' => 'numeric',
                            'width' => 'half',
                            'type' => 'integer',
                            'required' => true,
                        ],
                        [
                            'field' => 'height',
                            'interface' => 'numeric',
                            'width' => 'half',
                            'type' => 'integer',
                            'required' => true,
                        ],
                        [
                            'field' => 'quality',
                            'interface' => 'slider',
                            'type' => 'integer',
                            'default' => 80,
                            'options' => [
                                'min' => 0,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'required' => true,
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('fd6f95d2-359b-4e4f-bcb2-4ad0b84a5883')
                ->on('settings')
                ->name('asset_whitelist_system')
                ->json()
                ->required()
                ->width('half')
                ->hidden_browse()
                ->hidden_detail()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('400a3377-e277-47d4-83f9-07c0993ca7fe')
                ->on('settings')
                ->name('youtube_api_key')
                ->string()
                ->textInputInterface([
                    'iconRight' => 'videocam',
                ])
                ->note('Allows fetching more YouTube Embed info')
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('settings');
        Directus::databases()->system()->collection('settings')->drop();
    }
}
