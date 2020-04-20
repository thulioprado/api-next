<?php

declare(strict_types=1);

namespace Directus\Services\Activities;

use Carbon\Carbon;
use Directus\Contracts\Services\Service;
use Directus\Database\System\Models\Activity;
use Directus\Database\System\Models\Collection;
use Directus\Exceptions\ActivityNotFound;

class ActivitiesService implements Service
{
    public function all(): array
    {
        // TODO: validate parameters

        return Activity::all()->toArray();
    }

    /**
     * @param string $key the `id` or `name` of the collection
     *
     * @throws ActivityNotFound
     */
    public function find(string $key): array
    {
        // TODO: validate parameters

        $activity = Activity::find($key);
        if ($activity === null) {
            throw new ActivityNotFound($key);
        }

        return $activity->toArray();
    }

    /**
     * @param mixed $item
     */
    public function create(string $action, string $collection, $item, ?string $comment = null): array
    {
        // TODO: validate parameters
        $collection = directus()->collections()->find($collection);

        $activity = new Activity();
        $activity->action = $action;
        $activity->action_by = null; // TODO: associate user with the activity
        $activity->action_on = Carbon::now();
        $activity->ip = request()->ip();
        $activity->user_agent = request()->userAgent();
        $activity->item = $item;
        $activity->edited_on = null;
        $activity->comment = $comment;
        $activity->comment_deleted_on = null;
        $activity->collection_id = $collection['id'];

        $activity->save();

        return $activity->toArray();
    }

    /**
     * @param mixed $item
     */
    public function comment(string $comment, string $collection, $item): array
    {
        // TODO: validate parameters

        return $this->create('comment', $collection, $item, $comment);
    }

    /**
     * @throws ActivityNotFound
     */
    public function updateComment(string $key, string $comment): array
    {
        // TODO: validate parameters

        $activity = Activity::where('id', '=', $key)->where('action', '=', 'comment')->first();
        if ($activity === null) {
            throw new ActivityNotFound($key);
        }

        $activity->edited_on = Carbon::now();
        $activity->comment = $comment;

        $activity->save();

        return $activity->toArray();
    }

    /**
     * @throws ActivityNotFound
     */
    public function deleteComment(string $key): array
    {
        // TODO: validate parameters
        $activity = Activity::where('id', '=', $key)->where('action', '=', 'comment')->delete();

        return $activity->toArray();
    }
}
