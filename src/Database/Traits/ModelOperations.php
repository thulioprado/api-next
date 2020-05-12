<?php

declare(strict_types=1);

namespace Directus\Database\Traits;

trait ModelOperations
{
    /**
     * @param mixed $id
     * @param array $columns
     *
     * @return mixed
     */
    public static function findOrFail($id, $columns = ['*'])
    {
        try {
            $result = static::query()->findOrFail($id, $columns);
        } catch (\Throwable $t) {
            $exception = static::$exceptions['not_found'] ?? '\Exception';

            throw new $exception();
        }

        return $result;
    }

    /**
     * @param array $options
     */
    public function saveOrFail($options = []): bool
    {
        $saved = parent::save($options);

        if ($saved === false) {
            $exception = static::$exceptions['not_created'] ?? '\Exception'; // TODO: nem sempre vai ser create qnd der save

            throw new $exception();
        }

        return $saved;
    }
}
