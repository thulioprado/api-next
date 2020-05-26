<?php

declare(strict_types=1);

namespace Directus\GraphQL\Project\Types;

use Directus\Database\Models\Activity;
use Directus\Database\Models\Collection;
use Directus\Database\Models\Field;
use Directus\Database\Models\File;
use Directus\Database\Models\Folder;
use Directus\Database\Models\Permission;
use Directus\Database\Models\Preset;
use Directus\Database\Models\Relation;
use Directus\Database\Models\Revision;
use Directus\Database\Models\Role;
use Directus\Database\Models\User;
use Directus\GraphQL\Types\Models\ActivityType;
use Directus\GraphQL\Types\Models\CollectionType;
use Directus\GraphQL\Types\Models\FieldType;
use Directus\GraphQL\Types\Models\FileType;
use Directus\GraphQL\Types\Models\FolderType;
use Directus\GraphQL\Types\Models\PermissionType;
use Directus\GraphQL\Types\Models\PresetType;
use Directus\GraphQL\Types\Models\RelationType;
use Directus\GraphQL\Types\Models\RevisionType;
use Directus\GraphQL\Types\Models\RoleType;
use Directus\GraphQL\Types\Models\UserType;
use Directus\GraphQL\Types\Type;
use Directus\GraphQL\Types\Types;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class QueryType extends Type
{
    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveActivity($root, array $arguments)
    {
        return Activity::findOrFail($arguments['id']);
    }

    public function resolveActivities(): EloquentCollection
    {
        return Activity::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveFile($root, array $arguments)
    {
        return File::findOrFail($arguments['id']);
    }

    public function resolveFiles(): EloquentCollection
    {
        return File::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveCollection($root, array $arguments)
    {
        return Collection::findOrFail($arguments['id']);
    }

    public function resolveCollections(): EloquentCollection
    {
        return Collection::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveCollectionPreset($root, array $arguments)
    {
        return Preset::findOrFail($arguments['id']);
    }

    public function resolveCollectionPresets(): EloquentCollection
    {
        return Preset::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveField($root, array $arguments)
    {
        return Field::findOrFail($arguments['id']);
    }

    public function resolveFields(): EloquentCollection
    {
        return Field::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveFolder($root, array $arguments)
    {
        return Folder::findOrFail($arguments['id']);
    }

    public function resolveFolders(): EloquentCollection
    {
        return Folder::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolvePermission($root, array $arguments)
    {
        return Permission::findOrFail($arguments['id']);
    }

    public function resolvePermissions(): EloquentCollection
    {
        return Permission::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveRelation($root, array $arguments)
    {
        return Relation::findOrFail($arguments['id']);
    }

    public function resolveRelations(): EloquentCollection
    {
        return Relation::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveRevision($root, array $arguments)
    {
        return Revision::findOrFail($arguments['id']);
    }

    public function resolveRevisions(): EloquentCollection
    {
        return Revision::all();
    }

    public function resolveRoles(): EloquentCollection
    {
        return Role::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveRole($root, array $arguments)
    {
        return Role::findOrFail($arguments['id']);
    }

    public function resolveUsers(): EloquentCollection
    {
        return User::all();
    }

    /**
     * @param mixed $root
     *
     * @return mixed
     */
    public function resolveUser($root, array $arguments)
    {
        return User::findOrFail($arguments['id']);
    }

    protected function name(): string
    {
        return 'Query';
    }

    protected function description(): string
    {
        return 'Directus query object.';
    }

    protected function fields(): array
    {
        return [
            'activities' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(ActivityType::class)
                    )
                ),
                'description' => 'Project activities.',
            ],
            'activity' => [
                'type' => Types::required(Types::from(ActivityType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'files' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(FileType::class)
                    )
                ),
                'description' => 'Project files.',
            ],
            'file' => [
                'type' => Types::required(Types::from(FileType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'collections' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(CollectionType::class)
                    )
                ),
                'description' => 'Project collections.',
            ],
            'collection' => [
                'type' => Types::required(Types::from(CollectionType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'collection_presets' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(PresetType::class)
                    )
                ),
                'description' => 'Project collection presets.',
            ],
            'collection_preset' => [
                'type' => Types::required(Types::from(PresetType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'fields' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(FieldType::class)
                    )
                ),
                'description' => 'Project collection fields.',
            ],
            'field' => [
                'type' => Types::required(Types::from(FieldType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'folders' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(FolderType::class)
                    )
                ),
                'description' => 'Project folders.',
            ],
            'folder' => [
                'type' => Types::required(Types::from(FolderType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'permissions' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(PermissionType::class)
                    )
                ),
                'description' => 'Project permissions.',
            ],
            'permission' => [
                'type' => Types::required(Types::from(PermissionType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'relations' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(RelationType::class)
                    )
                ),
                'description' => 'Project relations.',
            ],
            'relation' => [
                'type' => Types::required(Types::from(RelationType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'revisions' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(RevisionType::class)
                    )
                ),
                'description' => 'Project revisions.',
            ],
            'revision' => [
                'type' => Types::required(Types::from(RevisionType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'roles' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(RoleType::class)
                    )
                ),
                'description' => 'Project roles.',
            ],
            'role' => [
                'type' => Types::required(Types::from(RoleType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
            'users' => [
                'type' => Types::required(
                    Types::list(
                        Types::from(UserType::class)
                    )
                ),
                'description' => 'Project users.',
            ],
            'user' => [
                'type' => Types::required(Types::from(UserType::class)),
                'args' => [
                    'id' => Types::required(Types::string()),
                ],
            ],
        ];
    }
}
