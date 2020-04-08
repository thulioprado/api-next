<?php

declare(strict_types=1);

use Directus\Database\Migrations\Traits\MigrateCollections;
use Directus\Database\Migrations\Traits\MigrateFields;
use Directus\Facades\Directus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusActivities extends Migration
{
    use MigrateFields;
    use
        MigrateCollections;

    /**
     * @var string
     */
    protected $uuid = '';

    /**
     * @var string
     */
    protected $name = 'activities';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $system = Directus::databases()->system();

        $system->schema()->create(
            $system->collection('activities')->name(),
            function (Blueprint $collection) use ($system): void {
                $collection->uuid('id')->primary();
                $collection->uuid('collection_id');
                $collection->string('action', 45);
                $collection->uuid('action_by')->nullable();
                $collection->dateTime('action_on')->nullable();
                $collection->ipAddress('ip');
                $collection->string('user_agent', 255);
                $collection->string('item', 255);
                $collection->dateTime('edited_on')->nullable();
                $collection->text('comment')->nullable();
                $collection->dateTime('comment_deleted_on')->nullable();
                $collection->foreign('collection_id')->references('id')->on(
                    $system->collection('collections')->name()
                );
            }
        );

        $this->registerCollection('c5e7edfd-f7e8-42b5-8da3-a433d3c7822b', 'activities');

        $this->registerField(
            $this->createField('9aa7a394-29ff-40b7-99a9-f28138749b9b')
                ->on('activities')
                ->uuid()
                ->name('id')
                ->readonly()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
        );

        $this->registerField(
            $this->createField('da74ddda-1194-445d-8f0a-a5dbdd5b2943')
                ->on('activities')
                ->string()
                ->name('collection_id')
                ->width('half')
                ->readonly()
                ->collectionsInterface([
                    'iconRight' => 'list_alt',
                    'include_system' => true,
                ])
        );

        $this->registerField(
            $this->createField('763901c9-8f3e-4566-a7fc-a35dff82a244')
                ->on('activities')
                ->string()
                ->name('action')
                ->readonly()
                ->textInputInterface([
                    'iconRight' => 'change_history',
                ])
        );

        $this->registerField(
            $this->createField('79a1e9b8-4c15-4ef7-b148-96cd9e82eafa')
                ->on('activities')
                ->string()
                ->name('action_by')
                ->readonly()
                ->width('half')
                ->userInterface([
                    'iconRight' => 'account_circle',
                ])
        );

        $this->registerField(
            $this->createField('c171cd1e-f981-44e8-8845-1376f76e1b88')
                ->on('activities')
                ->string()
                ->name('action_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'calendar_today',
                ])
        );

        $this->registerField(
            $this->createField('598f1f7e-fb08-427f-9450-c5339f31de75')
                ->on('activities')
                ->string()
                ->name('ip')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'my_location',
                ])
        );

        $this->registerField(
            $this->createField('2a3e626e-2a31-4624-b840-c844278ca686')
                ->on('activities')
                ->string()
                ->name('user_agent')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'devices_other',
                ])
        );

        $this->registerField(
            $this->createField('6989d278-7de6-4b2f-807c-b0eabbac9d75')
                ->on('activities')
                ->string()
                ->name('item')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'link',
                ])
        );

        $this->registerField(
            $this->createField('02bd5739-02a7-490f-b6b9-edb49e386669')
                ->on('activities')
                ->datetime()
                ->name('edited_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'edit',
                ])
        );

        $this->registerField(
            $this->createField('726aa859-05e9-4b3c-a8e7-5ebc07a7e04b')
                ->on('activities')
                ->string()
                ->name('comment')
                ->textInputInterface()
        );

        $this->registerField(
            $this->createField('258fe35b-762f-442a-b67c-7978c461d60d')
                ->on('activities')
                ->datetime()
                ->name('comment_deleted_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'delete_outline',
                ])
        );
    }

    /**
     * Rollback the migrations.
     */
    public function down(): void
    {
        $this->unregisterFieldsFrom('activities');
        Directus::databases()->system()->collection('activities')->drop();
    }
}
