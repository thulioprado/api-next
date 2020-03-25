<?php

declare(strict_types=1);

use Directus\Contracts\Database\System\Services\FieldsService;
use Directus\Database\System\Migration;
use Directus\Facades\Directus as Directus;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectusActivities extends Migration
{
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
        Directus::system()->schema()->create(
            Directus::system()->collection('activities')->name(),
            function (Blueprint $collection): void {
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
                    Directus::system()->collection('collections')->name()
                );
            }
        );

        Directus::collections()->register(
            Directus::system()->collection('activities')->fullName(),
            'c5e7edfd-f7e8-42b5-8da3-a433d3c7822b'
        );

        Directus::fields()->batch(function (FieldsService $fields): void {
            $fields->insert('9aa7a394-29ff-40b7-99a9-f28138749b9b', 0)
                ->on('activities')
                ->uuid()
                ->name('id')
                ->readonly()
                ->hidden_detail()
                ->textInputInterface([
                    'monospace' => true,
                ])
            ;

            $fields->insert('da74ddda-1194-445d-8f0a-a5dbdd5b2943', 1)
                ->on('activities')
                ->string()
                ->name('collection_id')
                ->width('half')
                ->readonly()
                ->collectionsInterface([
                    'iconRight' => 'list_alt',
                    'include_system' => true,
                ])
            ;

            $fields->insert('763901c9-8f3e-4566-a7fc-a35dff82a244', 2)
                ->on('activities')
                ->string()
                ->name('action')
                ->readonly()
                ->textInputInterface([
                    'iconRight' => 'change_history',
                ])
            ;

            $fields->insert('79a1e9b8-4c15-4ef7-b148-96cd9e82eafa', 3)
                ->on('activities')
                ->string()
                ->name('action_by')
                ->readonly()
                ->width('half')
                ->userInterface([
                    'iconRight' => 'account_circle',
                ])
            ;

            $fields->insert('c171cd1e-f981-44e8-8845-1376f76e1b88', 4)
                ->on('activities')
                ->string()
                ->name('action_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'calendar_today',
                ])
            ;

            $fields->insert('598f1f7e-fb08-427f-9450-c5339f31de75', 5)
                ->on('activities')
                ->string()
                ->name('ip')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'my_location',
                ])
            ;

            $fields->insert('2a3e626e-2a31-4624-b840-c844278ca686', 6)
                ->on('activities')
                ->string()
                ->name('user_agent')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'devices_other',
                ])
            ;

            $fields->insert('6989d278-7de6-4b2f-807c-b0eabbac9d75', 7)
                ->on('activities')
                ->string()
                ->name('item')
                ->readonly()
                ->width('half')
                ->textInputInterface([
                    'iconRight' => 'link',
                ])
            ;

            $fields->insert('02bd5739-02a7-490f-b6b9-edb49e386669', 8)
                ->on('activities')
                ->datetime()
                ->name('edited_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'edit',
                ])
            ;

            $fields->insert('726aa859-05e9-4b3c-a8e7-5ebc07a7e04b', 9)
                ->on('activities')
                ->string()
                ->name('comment')
                ->textInputInterface()
            ;

            $fields->insert('258fe35b-762f-442a-b67c-7978c461d60d', 10)
                ->on('activities')
                ->datetime()
                ->name('comment_deleted_on')
                ->readonly()
                ->width('half')
                ->datetimeInterface([
                    'showRelative' => true,
                    'iconRight' => 'delete_outline',
                ])
            ;
        });
    }

    public function down(): void
    {
        Directus::fields()->from(Directus::system()->collection('activities')->fullName())->delete();
        Directus::system()->collection('activities')->drop();
    }
}
