<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusUsers extends Migration
{
    use MigrateCollections;
    use MigrateFields;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('users')->name(),
            function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('role_id')->nullable();
                $collection->string('status', 32)->default('draft');
                $collection->string('first_name', 50)->nullable();
                $collection->string('last_name', 50)->nullable();
                $collection->string('email')->unique();
                $collection->string('password')->nullable();
                $collection->string('token')->unique()->nullable();
                $collection->string('timezone', 32)->default('America/New_York');
                $collection->string('locale', 8)->nullable();
                $collection->text('locale_options')->nullable();
                $collection->uuid('avatar_id')->nullable();
                $collection->string('company', 200)->nullable();
                $collection->string('title', 200)->nullable();
                $collection->boolean('email_notifications')->default(true);
                $collection->dateTime('last_access_on')->nullable();
                $collection->string('last_page', 200)->nullable();
                $collection->string('external_id')->unique()->nullable();
                $collection->string('theme', 100)->default('auto');
                $collection->string('twofactor_secret', 100)->nullable();
                $collection->string('password_reset_token', 520)->nullable();
                $collection->foreign('role_id')->references('id')->on(
                    $system->collection('roles')->name()
                );
                $collection->foreign('avatar_id')->references('id')->on(
                    $system->collection('files')->name()
                );
            }
        );

        $this->registerCollection('64d48fa7-9aff-4f87-a5d6-814a88b4d0d5', 'users');

        $this->registerField(
            $this->createField('1723a7af-72dc-43fd-918a-c882b9364075')
                ->on('users')
                ->uuidType()
                ->name('id')
                ->required()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('c508dafe-dec3-4185-bf5a-3713db9450a8')
                ->on('users')
                ->m2oType()
                ->name('role_id')
                ->required()
                ->width('half')
                ->userRolesInterface()
        );

        $this->registerField(
            $this->createField('750a25e3-f3fd-42b0-aeab-2bfc5c472b27')
                ->on('users')
                ->statusType()
                ->name('status')
                ->required()
                ->statusInterface([
                    'status_mapping' => [
                        'draft' => [
                            'name' => 'Draft',
                            'text_color' => 'white',
                            'background_color' => 'light-gray',
                            'listing_subdued' => false,
                            'listing_badge' => true,
                            'soft_delete' => false,
                        ],
                        'invited' => [
                            'name' => 'Invited',
                            'text_color' => 'white',
                            'background_color' => 'light-gray',
                            'listing_subdued' => false,
                            'listing_badge' => true,
                            'soft_delete' => false,
                        ],
                        'active' => [
                            'name' => 'Active',
                            'text_color' => 'white',
                            'background_color' => 'success',
                            'listing_subdued' => false,
                            'listing_badge' => false,
                            'soft_delete' => false,
                        ],
                        'suspended' => [
                            'name' => 'Suspended',
                            'text_color' => 'white',
                            'background_color' => 'light-gray',
                            'listing_subdued' => false,
                            'listing_badge' => true,
                            'soft_delete' => false,
                        ],
                        'deleted' => [
                            'name' => 'Deleted',
                            'text_color' => 'white',
                            'background_color' => 'danger',
                            'listing_subdued' => false,
                            'listing_badge' => true,
                            'soft_delete' => true,
                        ],
                    ],
                ])
        );

        $this->registerField(
            $this->createField('ae6ab8e0-d3a2-465a-9f49-611c9999e03f')
                ->on('users')
                ->stringType()
                ->name('first_name')
                ->required()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'account_circle',
                ])
        );

        $this->registerField(
            $this->createField('4b753eea-797e-4df0-b9f7-0542b0deab14')
                ->on('users')
                ->stringType()
                ->name('last_name')
                ->required()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'account_circle',
                ])
        );

        $this->registerField(
            $this->createField('437c7847-346c-48ae-90a5-0da7f4bcec78')
                ->on('users')
                ->stringType()
                ->name('email')
                ->required()
                ->width('half')
                ->validation('$email')
                ->textInputInterface([
                    'iconRight' => 'alternate_email',
                ])
        );

        $this->registerField(
            $this->createField('b028454d-4c94-4748-b9b6-faee9ce6500e')
                ->on('users')
                ->hashType()
                ->name('password')
                ->required()
                ->width('half')
                ->passwordInterface()
        );

        $this->registerField(
            $this->createField('34dfcbc8-e622-4941-9528-80c8057b319e')
                ->on('users')
                ->stringType()
                ->name('token')
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('f834c2c1-92ff-43d4-8913-24b53ef2f408')
                ->on('users')
                ->stringType()
                ->name('timezone')
                ->required()
                ->width('half')
                ->dropdownInterface([
                    'choices' => [
                        'Pacific/Midway' => '(UTC-11:00) Midway Island',
                        'Pacific/Samoa' => '(UTC-11:00) Samoa',
                        'Pacific/Honolulu' => '(UTC-10:00) Hawaii',
                        'US/Alaska' => '(UTC-09:00) Alaska',
                        'America/Los_Angeles' => '(UTC-08:00) Pacific Time (US & Canada)',
                        'America/Tijuana' => '(UTC-08:00) Tijuana',
                        'US/Arizona' => '(UTC-07:00) Arizona',
                        'America/Chihuahua' => '(UTC-07:00) Chihuahua',
                        'America/Mexico/La_Paz' => '(UTC-07:00) La Paz',
                        'America/Mazatlan' => '(UTC-07:00) Mazatlan',
                        'US/Mountain' => '(UTC-07:00) Mountain Time (US & Canada)',
                        'America/Managua' => '(UTC-06:00) Central America',
                        'US/Central' => '(UTC-06:00) Central Time (US & Canada)',
                        'America/Guadalajara' => '(UTC-06:00) Guadalajara',
                        'America/Mexico_City' => '(UTC-06:00) Mexico City',
                        'America/Monterrey' => '(UTC-06:00) Monterrey',
                        'Canada/Saskatchewan' => '(UTC-06:00) Saskatchewan',
                        'America/Bogota' => '(UTC-05:00) Bogota',
                        'US/Eastern' => '(UTC-05:00) Eastern Time (US & Canada)',
                        'US/East-Indiana' => '(UTC-05:00) Indiana (East)',
                        'America/Lima' => '(UTC-05:00) Lima',
                        'America/Quito' => '(UTC-05:00) Quito',
                        'Canada/Atlantic' => '(UTC-04:00) Atlantic Time (Canada)',
                        'America/New_York' => '(UTC-04:00) New York',
                        'America/Caracas' => '(UTC-04:30) Caracas',
                        'America/La_Paz' => '(UTC-04:00) La Paz',
                        'America/Santiago' => '(UTC-04:00) Santiago',
                        'America/Santo_Domingo' => '(UTC-04:00) Santo Domingo',
                        'Canada/Newfoundland' => '(UTC-03:30) Newfoundland',
                        'America/Sao_Paulo' => '(UTC-03:00) Brasilia',
                        'America/Argentina/Buenos_Aires' => '(UTC-03:00) Buenos Aires',
                        'America/Argentina/GeorgeTown' => '(UTC-03:00) Georgetown',
                        'America/Godthab' => '(UTC-03:00) Greenland',
                        'America/Noronha' => '(UTC-02:00) Mid-Atlantic',
                        'Atlantic/Azores' => '(UTC-01:00) Azores',
                        'Atlantic/Cape_Verde' => '(UTC-01:00) Cape Verde Is.',
                        'Africa/Casablanca' => '(UTC+00:00) Casablanca',
                        'Europe/Edinburgh' => '(UTC+00:00) Edinburgh',
                        'Etc/Greenwich' => '(UTC+00:00) Greenwich Mean Time : Dublin',
                        'Europe/Lisbon' => '(UTC+00:00) Lisbon',
                        'Europe/London' => '(UTC+00:00) London',
                        'Africa/Monrovia' => '(UTC+00:00) Monrovia',
                        'UTC' => '(UTC+00:00) UTC',
                        'Europe/Amsterdam' => '(UTC+01:00) Amsterdam',
                        'Europe/Belgrade' => '(UTC+01:00) Belgrade',
                        'Europe/Berlin' => '(UTC+01:00) Berlin',
                        'Europe/Bern' => '(UTC+01:00) Bern',
                        'Europe/Bratislava' => '(UTC+01:00) Bratislava',
                        'Europe/Brussels' => '(UTC+01:00) Brussels',
                        'Europe/Budapest' => '(UTC+01:00) Budapest',
                        'Europe/Copenhagen' => '(UTC+01:00) Copenhagen',
                        'Europe/Ljubljana' => '(UTC+01:00) Ljubljana',
                        'Europe/Madrid' => '(UTC+01:00) Madrid',
                        'Europe/Paris' => '(UTC+01:00) Paris',
                        'Europe/Prague' => '(UTC+01:00) Prague',
                        'Europe/Rome' => '(UTC+01:00) Rome',
                        'Europe/Sarajevo' => '(UTC+01:00) Sarajevo',
                        'Europe/Skopje' => '(UTC+01:00) Skopje',
                        'Europe/Stockholm' => '(UTC+01:00) Stockholm',
                        'Europe/Vienna' => '(UTC+01:00) Vienna',
                        'Europe/Warsaw' => '(UTC+01:00) Warsaw',
                        'Africa/Lagos' => '(UTC+01:00) West Central Africa',
                        'Europe/Zagreb' => '(UTC+01:00) Zagreb',
                        'Europe/Athens' => '(UTC+02:00) Athens',
                        'Europe/Bucharest' => '(UTC+02:00) Bucharest',
                        'Africa/Cairo' => '(UTC+02:00) Cairo',
                        'Africa/Harare' => '(UTC+02:00) Harare',
                        'Europe/Helsinki' => '(UTC+02:00) Helsinki',
                        'Europe/Istanbul' => '(UTC+02:00) Istanbul',
                        'Asia/Jerusalem' => '(UTC+02:00) Jerusalem',
                        'Europe/Kyiv' => '(UTC+02:00) Kyiv',
                        'Africa/Johannesburg' => '(UTC+02:00) Pretoria',
                        'Europe/Riga' => '(UTC+02:00) Riga',
                        'Europe/Sofia' => '(UTC+02:00) Sofia',
                        'Europe/Tallinn' => '(UTC+02:00) Tallinn',
                        'Europe/Vilnius' => '(UTC+02:00) Vilnius',
                        'Asia/Baghdad' => '(UTC+03:00) Baghdad',
                        'Asia/Kuwait' => '(UTC+03:00) Kuwait',
                        'Europe/Minsk' => '(UTC+03:00) Minsk',
                        'Africa/Nairobi' => '(UTC+03:00) Nairobi',
                        'Asia/Riyadh' => '(UTC+03:00) Riyadh',
                        'Europe/Volgograd' => '(UTC+03:00) Volgograd',
                        'Asia/Tehran' => '(UTC+03:30) Tehran',
                        'Asia/Abu_Dhabi' => '(UTC+04:00) Abu Dhabi',
                        'Asia/Baku' => '(UTC+04:00) Baku',
                        'Europe/Moscow' => '(UTC+04:00) Moscow',
                        'Asia/Muscat' => '(UTC+04:00) Muscat',
                        'Europe/St_Petersburg' => '(UTC+04:00) St. Petersburg',
                        'Asia/Tbilisi' => '(UTC+04:00) Tbilisi',
                        'Asia/Yerevan' => '(UTC+04:00) Yerevan',
                        'Asia/Kabul' => '(UTC+04:30) Kabul',
                        'Asia/Islamabad' => '(UTC+05:00) Islamabad',
                        'Asia/Karachi' => '(UTC+05:00) Karachi',
                        'Asia/Tashkent' => '(UTC+05:00) Tashkent',
                        'Asia/Calcutta' => '(UTC+05:30) Chennai',
                        'Asia/Kolkata' => '(UTC+05:30) Kolkata',
                        'Asia/Mumbai' => '(UTC+05:30) Mumbai',
                        'Asia/New_Delhi' => '(UTC+05:30) New Delhi',
                        'Asia/Sri_Jayawardenepura' => '(UTC+05:30) Sri Jayawardenepura',
                        'Asia/Katmandu' => '(UTC+05:45) Kathmandu',
                        'Asia/Almaty' => '(UTC+06:00) Almaty',
                        'Asia/Astana' => '(UTC+06:00) Astana',
                        'Asia/Dhaka' => '(UTC+06:00) Dhaka',
                        'Asia/Yekaterinburg' => '(UTC+06:00) Ekaterinburg',
                        'Asia/Rangoon' => '(UTC+06:30) Rangoon',
                        'Asia/Bangkok' => '(UTC+07:00) Bangkok',
                        'Asia/Hanoi' => '(UTC+07:00) Hanoi',
                        'Asia/Jakarta' => '(UTC+07:00) Jakarta',
                        'Asia/Novosibirsk' => '(UTC+07:00) Novosibirsk',
                        'Asia/Beijing' => '(UTC+08:00) Beijing',
                        'Asia/Chongqing' => '(UTC+08:00) Chongqing',
                        'Asia/Hong_Kong' => '(UTC+08:00) Hong Kong',
                        'Asia/Krasnoyarsk' => '(UTC+08:00) Krasnoyarsk',
                        'Asia/Kuala_Lumpur' => '(UTC+08:00) Kuala Lumpur',
                        'Australia/Perth' => '(UTC+08:00) Perth',
                        'Asia/Singapore' => '(UTC+08:00) Singapore',
                        'Asia/Taipei' => '(UTC+08:00) Taipei',
                        'Asia/Ulan_Bator' => '(UTC+08:00) Ulaan Bataar',
                        'Asia/Urumqi' => '(UTC+08:00) Urumqi',
                        'Asia/Irkutsk' => '(UTC+09:00) Irkutsk',
                        'Asia/Osaka' => '(UTC+09:00) Osaka',
                        'Asia/Sapporo' => '(UTC+09:00) Sapporo',
                        'Asia/Seoul' => '(UTC+09:00) Seoul',
                        'Asia/Tokyo' => '(UTC+09:00) Tokyo',
                        'Australia/Adelaide' => '(UTC+09:30) Adelaide',
                        'Australia/Darwin' => '(UTC+09:30) Darwin',
                        'Australia/Brisbane' => '(UTC+10:00) Brisbane',
                        'Australia/Canberra' => '(UTC+10:00) Canberra',
                        'Pacific/Guam' => '(UTC+10:00) Guam',
                        'Australia/Hobart' => '(UTC+10:00) Hobart',
                        'Australia/Melbourne' => '(UTC+10:00) Melbourne',
                        'Pacific/Port_Moresby' => '(UTC+10:00) Port Moresby',
                        'Australia/Sydney' => '(UTC+10:00) Sydney',
                        'Asia/Yakutsk' => '(UTC+10:00) Yakutsk',
                        'Asia/Vladivostok' => '(UTC+11:00) Vladivostok',
                        'Pacific/Auckland' => '(UTC+12:00) Auckland',
                        'Pacific/Fiji' => '(UTC+12:00) Fiji',
                        'Pacific/Kwajalein' => '(UTC+12:00) International Date Line West',
                        'Asia/Kamchatka' => '(UTC+12:00) Kamchatka',
                        'Asia/Magadan' => '(UTC+12:00) Magadan',
                        'Pacific/Marshall_Is' => '(UTC+12:00) Marshall Is.',
                        'Asia/New_Caledonia' => '(UTC+12:00) New Caledonia',
                        'Asia/Solomon_Is' => '(UTC+12:00) Solomon Is.',
                        'Pacific/Wellington' => '(UTC+12:00) Wellington',
                        'Pacific/Tongatapu' => '(UTC+13:00) Nuku\'alofa',
                    ],
                    'placeholder' => 'Choose a timezone...',
                ])
        );

        $this->registerField(
            $this->createField('dc85c5b6-7995-4d8c-b904-df8133deec35')
                ->on('users')
                ->stringType()
                ->name('language')
                ->required()
                ->width('half')
                ->languageInterface([
                    'limit' => true,
                ])
        );

        $this->registerField(
            $this->createField('0ace83b0-eb7e-496b-9ba2-9e093721a971')
                ->on('users')
                ->jsonType()
                ->name('locale_options')
                ->hidden_browse()
                ->hidden_detail()
                ->jsonInterface()
        );

        $this->registerField(
            $this->createField('b9f62f91-99b8-40f0-a657-d7c23e34bba5')
                ->on('users')
                ->fileType()
                ->name('avatar_id')
                ->fileInterface()
        );

        $this->registerField(
            $this->createField('276efc8f-01ab-4cb9-8302-c1db95976145')
                ->on('users')
                ->stringType()
                ->name('company')
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'location_city',
                ])
        );

        $this->registerField(
            $this->createField('c30992d2-97d0-4749-baf8-7dc69d981983')
                ->on('users')
                ->stringType()
                ->name('title')
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'text_fields',
                ])
        );

        $this->registerField(
            $this->createField('6040af16-3976-49c6-a280-8a1e2443a307')
                ->on('users')
                ->booleanType()
                ->name('email_notifications')
                ->width('half')
                ->switchInterface()
        );

        $this->registerField(
            $this->createField('f6c81a4d-5b45-4bb9-ba7c-39dc5c4afa9b')
                ->on('users')
                ->datetimeType()
                ->name('last_access_on')
                ->readonly()
                ->hidden_detail()
                ->datetimeInterface()
        );

        $this->registerField(
            $this->createField('e3786b21-d235-4268-9567-fd597d61a385')
                ->on('users')
                ->stringType()
                ->name('last_page')
                ->readonly()
                ->hidden_detail()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('145270cf-068f-4305-a339-257642752d8e')
                ->on('users')
                ->stringType()
                ->name('external_id')
                ->readonly()
                ->hidden_detail()
                ->hidden_browse()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('bc9703de-de88-46e1-b661-824b0770fe18')
                ->on('users')
                ->stringType()
                ->name('theme')
                ->radioButtonsInterface([
                    'format' => true,
                    'choices' => [
                        'auto' => 'Auto',
                        'light' => 'Light',
                        'dark' => 'Dark',
                    ],
                ])
        );

        $this->registerField(
            $this->createField('bc80eea0-1eef-48aa-809d-5436f67567e4')
                ->on('users')
                ->stringType()
                ->name('twofactor_secret')
                ->readonly()
                ->twoFactorSecretInterface()
        );

        $this->registerField(
            $this->createField('cee1f872-9542-4b8d-a01a-e4f83e65a8a0')
                ->on('users')
                ->stringType()
                ->name('password_reset_token')
                ->readonly()
                ->hidden_detail()
                ->textInputInterface()
        );

        // TODO: Enable after roles and files
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('users');
        Directus::databases()->system()->collection('users')->drop();
    }
}
