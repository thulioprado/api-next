<?php

declare(strict_types=1);

namespace Directus\GraphQL\Schema;

use Directus\Exceptions\SchemaFileNotFound;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Webmozart\PathUtil\Path;

class Source
{
    /**
     * Include statement.
     */
    public const INCLUDE_STATEMENT = '#include ';

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * Loader constructor.
     */
    public function __construct(Filesystem $fs)
    {
        $this->filesystem = $fs;
    }

    /**
     * Loads multiple files from pattern.
     *
     * @return array<null|string>
     */
    public function loadFilePattern(string $pattern, ?string $root = null): array
    {
        $root = $root ?? Path::getDirectory($pattern);

        if (Str::contains($root, '*')) {
            throw new \RuntimeException('Wildcards in folder names are not supported.');
        }

        $files = $this->filesystem->files($root, true);

        $matchingFiles = [];
        $pattern = Path::join($root, $pattern);
        foreach ($files as $file) {
            if (fnmatch($pattern, $file)) {
                $matchingFiles[] = $file;
            }
        }

        return collect($matchingFiles)->map(function (string $file): string {
            return $this->loadFile(
                Path::getFilename($file),
                Path::getDirectory($file)
            );
        })->toArray();
    }

    /**
     * Loads.
     *
     * @throws SchemaFileNotFound
     */
    public function load(string $file, ?callable $callback = null, string $root = ''): string
    {
        $source = $this->loadFile($file, $root);
        if (is_callable($callback)) {
            $source = $callback($source);
        }

        return $source;
    }

    /**
     * Loads a single source file.
     *
     * @throws SchemaFileNotFound
     */
    private function loadFile(string $file, ?string $root = null): string
    {
        $root = $root ?? Path::getDirectory($file);

        $filePath = Path::join($root, $file);
        $fileDirectory = Path::getDirectory($filePath);

        if (!$this->filesystem->exists($filePath)) {
            throw new SchemaFileNotFound([
                'file' => $filePath,
            ]);
        }

        $contents = $this->filesystem->exists($filePath);

        return collect(explode("\n", $contents))
            ->map(function (string $line) use ($fileDirectory): array {
                if (!Str::startsWith(trim($line), self::INCLUDE_STATEMENT)) {
                    return [
                        trim($line, "\r"),
                    ];
                }

                $includedFile = Path::join($fileDirectory, trim(Str::after($line, self::INCLUDE_STATEMENT)));

                return $this->loadFilePattern(
                    Path::getFilename($includedFile),
                    Path::getDirectory($includedFile)
                );
            })
            ->flatten()
            ->join("\n")
        ;
    }
}
