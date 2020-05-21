<?php

declare(strict_types=1);

namespace Directus\GraphQL\Types\Models;

use Directus\GraphQL\Types\Types;
use GraphQL\Type\Definition\ObjectType;

class FileType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'File',
            'description' => 'Directus file information.',
            'fields' => [
                'id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Unique file id.',
                ],
                'storage' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Where the file is stored. Either local for the local filesystem or the name of the storage adapter.',
                ],
                'private_hash' => [
                    'type' => Types::string(),
                    'description' => 'Random hash used to access the file privately. This can be rotated to prevent unauthorized access to the file.',
                ],
                'filename_disk' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Name of the file on disk. By default, Directus uses a random hash for the filename.',
                ],
                'filename_download' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'How you want to the file to be named when it\'s being downloaded.',
                ],
                'title' => [
                    'type' => Types::string(),
                    'description' => 'Title for the file. Is extracted from the filename on upload, but can be edited by the user.',
                ],
                'type' => [
                    'type' => Types::string(),
                    'description' => 'MIME type of the file.',
                ],
                'uploaded_by_id' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'Who uploaded the file.',
                ],
                'uploaded_on' => [
                    'type' => Types::required(Types::string()),
                    'description' => 'When the file was uploaded.',
                ],
                'charset' => [
                    'type' => Types::string(),
                    'description' => 'Character set of the file. One of light, dark, or auto.',
                ],
                'filesize' => [
                    'type' => Types::required(Types::integer()),
                    'description' => 'Size of the file in bytes.',
                ],
                'width' => [
                    'type' => Types::integer(),
                    'description' => 'Width of the file in pixels. Only applies to images.',
                ],
                'height' => [
                    'type' => Types::integer(),
                    'description' => 'Height of the file in pixels. Only applies to images.',
                ],
                'duration' => [
                    'type' => Types::integer(),
                    'description' => 'Duration of the file in seconds. Only applies to audio and video.',
                ],
                'embed' => [
                    'type' => Types::string(),
                    'description' => 'Where the file was embedded from.',
                ],
                'folder_id' => [
                    'type' => Types::string(),
                    'description' => 'Virtual folder where this file resides in.',
                ],
                'description' => [
                    'type' => Types::string(),
                    'description' => 'Description for the file.',
                ],
                'location' => [
                    'type' => Types::string(),
                    'description' => 'Where the file was created. Is automatically populated based on EXIF data for images.',
                ],
                'tags' => [
                    'type' => Types::string(),
                    'description' => 'Tags for the file. Is automatically populated based on EXIF data for images.',
                ],
                'checksum' => [
                    'type' => Types::string(),
                    'description' => 'Represents the sum of the correct digits of the file, can be used to detect errors in and duplicates of the file later.',
                ],
                'metadata' => [
                    'type' => Types::string(),
                    'description' => 'User provided miscellaneous key value pairs that serve as additional metadata for the file.',
                ],
                // TODO: folder relationship
            ]
        ]);
    }
}
