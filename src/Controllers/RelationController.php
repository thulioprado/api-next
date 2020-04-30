<?php

declare(strict_types=1);

namespace Directus\Controllers;

use Directus\Database\Models\Relation;
use Directus\Exceptions\RelationNotCreated;
use Directus\Exceptions\RelationNotFound;
use Directus\Requests\RelationRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

/**
 * Revision controller.
 */
class RelationController extends BaseController
{
    public function all(): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Collection $relations */
        $relations = Relation::with(['fieldMany', 'fieldOne', 'junctionField'])->get();

        return directus()->respond()->with($relations->toArray());
    }

    /**
     * @throws RelationNotFound
     */
    public function fetch(string $key): JsonResponse
    {
        // TODO: validate query parameters

        /** @var Relation $relation */
        $relation = Relation::with(['fieldMany', 'fieldOne', 'junctionField'])->findOrFail($key);

        return directus()->respond()->with($relation->toArray());
    }

    /**
     * @throws RelationNotCreated|RelationNotFound
     */
    public function create(RelationRequest $request): JsonResponse
    {
        $attributes = $request->all();

        $relation_id = directus()->databases()->system()->transaction(function () use ($attributes): string {
            /** @var Relation $relation */
            $relation = new Relation($attributes);
            $relation->saveOrFail();

            return $relation->id;
        });

        /** @var Relation $relation */
        $relation = Relation::with(['fieldMany', 'fieldOne', 'junctionField'])->findOrFail($relation_id);

        return directus()->respond()->with($relation->toArray());
    }

    /**
     * @throws RelationNotFound
     */
    public function update(string $key, RelationRequest $request): JsonResponse
    {
        /** @var Relation $relation */
        $relation = Relation::with(['fieldMany', 'fieldOne', 'junctionField'])->findOrFail($key);
        $relation->update($request->all());

        return directus()->respond()->with($relation->toArray());
    }

    /**
     * @throws RelationNotFound
     */
    public function delete(string $key): JsonResponse
    {
        /** @var Relation $relation */
        $relation = Relation::findOrFail($key);
        $relation->delete();

        return directus()->respond()->withNothing();
    }
}
