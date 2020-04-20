<?php

declare(strict_types=1);

namespace Directus\Database\Traits;

use Directus\Contracts\Database\Database;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Nonstandard\Uuid;

/**
 * System model.
 *
 * @mixin Model
 */
trait FromSystemDatabase
{
    /**
     * @var null|array
     */
    private static $traits = null;

    /**
     * Model constructor.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $system = $this->system();

        $this->setConnection($system->connectionName());
        $this->setTable($system->collection($this->getTable())->name());
        $this->timestamps = false;
    }

    /**
     * Boot model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::$traits = static::$traits ?? array_flip(class_uses_recursive(static::class));

        static::creating(static function (Model $new): void {
            $new->setKeyType($new->getKeyType());
            $new->setIncrementing($new->getIncrementing());
            if (isset(static::$traits[UsesUuidPrimaryKey::class])) {
                $key = $new->getKey();
                if ($key === '' || $key === null) {
                    $new->setAttribute($new->getKeyName(), Uuid::uuid4()->toString());
                }
            }
        });
    }

    /**
     * Gets the system database.
     */
    protected function system(): Database
    {
        return resolve(Database::class, [
            'name' => 'system',
        ]);
    }
}
