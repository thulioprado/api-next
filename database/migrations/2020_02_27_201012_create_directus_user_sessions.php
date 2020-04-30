<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusUserSessions extends Migration
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
            $system->collection('user_sessions')->name(),
            function (Blueprint $collection) use ($system) {
                $collection->uuid('id')->primary();
                $collection->uuid('user_id')->nullable();
                $collection->string('token_type', 255)->nullable();
                $collection->string('token', 520)->nullable();
                $collection->string('ip_address', 255)->nullable();
                $collection->text('user_agent')->nullable();
                $collection->dateTime('created_on')->nullable();
                $collection->dateTime('token_expired_at')->nullable();

                $collection->foreign('user_id')->references('id')->on(
                    $system->collection('users')->name()
                );
            }
        );

        $this->registerCollection('153ea9ae-69b2-401f-b05e-0f97f2782077', 'user_sessions');

        $this->registerField(
            $this->createField('1644a555-6b80-42b3-8cf5-2c74ac83c353')
                ->on('user_sessions')
                ->name('id')
                ->uuidType()
                ->hidden_detail()
                ->required()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('d732b460-4c14-482b-89a7-4d8eddea2fe9')
                ->on('user_sessions')
                ->name('user')
                ->userType()
                ->unlocked()
                ->required()
                ->userInterface()
        );

        $this->registerField(
            $this->createField('66e27952-5a21-4c5c-ae50-1c4e351fd8db')
                ->on('user_sessions')
                ->name('token_type')
                ->stringType()
                ->unlocked()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('059ee58c-34cc-4237-bb41-3837d2c2c6c5')
                ->on('user_sessions')
                ->name('token')
                ->stringType()
                ->unlocked()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('f404fe26-e41c-4abb-a80f-15e0955399ef')
                ->on('user_sessions')
                ->name('ip_address')
                ->stringType()
                ->unlocked()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('0c5d9507-d49d-4ffe-834a-bcaacbee24d4')
                ->on('user_sessions')
                ->name('user_agent')
                ->stringType()
                ->unlocked()
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('9a263038-c0ce-4a78-af6c-072dd79be29a')
                ->on('user_sessions')
                ->name('created_on')
                ->datetimeType()
                ->unlocked()
                ->datetimeInterface()
        );

        $this->registerField(
            $this->createField('1b880d8d-3aed-4467-aa1d-5e6b01f33e9b')
                ->on('user_sessions')
                ->name('token_expired_at')
                ->datetimeType()
                ->unlocked()
                ->datetimeInterface()
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('user_sessions');
        Directus::databases()->system()->collection('user_sessions')->drop();
    }
}
