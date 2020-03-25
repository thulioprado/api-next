<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusUserSessions extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Directus::system()->schema()->create(
            Directus::system()->collection('user_sessions')->name(),
            function (Blueprint $collection) {
                $collection->bigIncrements('id');
                $collection->uuid('user_id')->nullable();
                $collection->string('token_type', 255)->nullable();
                $collection->string('token', 520)->nullable();
                $collection->string('ip_address', 255)->nullable();
                $collection->text('user_agent')->nullable();
                $collection->dateTime('created_on')->nullable();
                $collection->dateTime('token_expired_at')->nullable();

                $collection->foreign('user_id')->references('id')->on(
                    Directus::system()->collection('users')->name()
                );
            }
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('1644a555-6b80-42b3-8cf5-2c74ac83c353')
                ->on('user_sessions')
                ->name('id')
                ->integer()
                ->hidden_detail()
            ;
            $fields->insert('d732b460-4c14-482b-89a7-4d8eddea2fe9')
                ->on('user_sessions')
                ->name('user')
                ->user()
                ->locked(false)
                ->required()
            ;
            $fields->insert('66e27952-5a21-4c5c-ae50-1c4e351fd8db')
                ->on('user_sessions')
                ->name('token_type')
                ->string()
                ->locked(false)
            ;
            $fields->insert('059ee58c-34cc-4237-bb41-3837d2c2c6c5')
                ->on('user_sessions')
                ->name('token')
                ->string()
                ->locked(false)
            ;
            $fields->insert('f404fe26-e41c-4abb-a80f-15e0955399ef')
                ->on('user_sessions')
                ->name('ip_address')
                ->string()
                ->locked(false)
            ;
            $fields->insert('0c5d9507-d49d-4ffe-834a-bcaacbee24d4')
                ->on('user_sessions')
                ->name('user_agent')
                ->string()
                ->locked(false)
            ;
            $fields->insert('9a263038-c0ce-4a78-af6c-072dd79be29a')
                ->on('user_sessions')
                ->name('created_on')
                ->datetime()
                ->locked(false)
            ;
            $fields->insert('1b880d8d-3aed-4467-aa1d-5e6b01f33e9b')
                ->on('user_sessions')
                ->name('token_expired_at')
                ->datetime()
                ->locked(false)
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Directus::system()->collection('user_sessions')->drop();
    }
}
