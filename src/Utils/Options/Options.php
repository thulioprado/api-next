<?php

declare(strict_types=1);

namespace Directus\Utils\Options;

use Directus\Utils\Options\Exception\EmptySchema;
use Directus\Utils\Options\Exception\InvalidOption;
use Directus\Utils\Options\Exception\MissingOptions;
use Illuminate\Support\Arr;

/**
 * Options collection and validation class.
 */
class Options
{
    /**
     * Default values.
     */
    public const PROP_DEFAULT = 'default';
    public const PROP_CONVERT = 'convert';
    public const PROP_VALIDATE = 'validate';

    /**
     * Collection items.
     *
     * @var array<mixed>
     */
    private $values = [];

    /**
     * List of schema rules.
     *
     * @var array<mixed>
     */
    private $schema = [];

    /**
     * List of required props.
     *
     * @var array
     */
    private $required = [];

    /**
     * Collection constructor.
     *
     * @throws EmptySchema
     */
    public function __construct(array $schema, ?array $values = null)
    {
        if (\count($schema) === 0) {
            throw new EmptySchema();
        }

        $this->schema = array_replace_recursive([], ...array_map(function ($key, $value) {
            if (\is_string($key)) {
                if (!\is_array($value)) {
                    $value = [
                        self::PROP_DEFAULT => $value,
                    ];
                }
            } else {
                if (!\is_string($value)) {
                    throw new InvalidOption((string) $value);
                }

                $key = $value;
                $value = [];
            }

            return array_replace_recursive([], [
                $key => [
                    self::PROP_VALIDATE => function (): bool {
                        return true;
                    },
                    self::PROP_CONVERT => function ($value) {
                        return $value;
                    },
                ],
            ], [
                $key => $value,
            ]);
        }, array_keys($schema), array_values($schema)));

        $attributes = array_keys($this->schema);

        $this->required = Arr::where($attributes, function ($prop): bool {
            return !\array_key_exists(self::PROP_DEFAULT, $this->schema[$prop]);
        });

        if ($values !== null) {
            $this->feed($values);
        }
    }

    /**
     * Feeds data to options class.
     *
     * @throws MissingOptions
     */
    public function feed(array $data): void
    {
        $missing = Arr::where($this->required, function ($key) use ($data): bool {
            return !Arr::has($data, $key);
        });

        if (\count($missing) > 0) {
            throw new MissingOptions($missing);
        }

        $this->values = $data;
        foreach ($this->schema as $key => $prop) {
            $key = (string) $key;
            if (Arr::has($data, $key)) {
                $value = Arr::get($data, $key);
            } else {
                $value = $prop[self::PROP_DEFAULT];
            }

            if (!$prop[self::PROP_VALIDATE]($value)) {
                throw new InvalidOption($key);
            }

            Arr::set($this->values, $key, $prop[self::PROP_CONVERT]($value));
        }
    }

    /**
     * Gets an item in the collection with the given key.
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return Arr::get($this->values, $key);
    }

    /**
     * Checks whether an item exists in the collection with the given key.
     */
    public function has(string $key): bool
    {
        return Arr::has($this->values, $key);
    }
}
