<?php

declare(strict_types=1);

namespace Directus\Database\Models;

use DateTime;
use Directus\Database\Traits\FromSystemDatabase;
use Directus\Database\Traits\UsesUuidPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Collection model.
 *
 * @property string      $id
 * @property string      $storage
 * @property null|string $private_hash
 * @property string      $filename_disk
 * @property string      $filename_download
 * @property null|string $title
 * @property null|string $type
 * @property string      $uploaded_by_id
 * @property DateTime    $uploaded_on
 * @property null|string $charset
 * @property int         $filesize
 * @property null|int    $width
 * @property null|int    $height
 * @property null|int    $duration
 * @property null|string $embed
 * @property null|string $folder_id
 * @property null|string $description
 * @property null|string $location
 * @property null|string $tags
 * @property null|string $checksum
 * @property null|string $metadata
 *
 * @mixin Model
 * @mixin Builder
 */
class File extends Model
{
    use FromSystemDatabase;
    use UsesUuidPrimaryKey;

    /**
     * @var array
     */
    protected $casts = [
        'uploaded_on' => 'datetime',
    ];

    /**
     * @var array<string>
     */
    protected $fillable = [
        'storage',
        'private_hash',
        'filename_disk',
        'filename_download',
        'title',
        'type',
        'uploaded_by_id',
        'uploaded_on',
        'charset',
        'filesize',
        'width',
        'height',
        'duration',
        'embed',
        'folder_id',
        'description',
        'location',
        'tags',
        'checksum',
        'metadata',
    ];

    /**
     * @var array<string>
     */
    protected $hidden = [
        'folder_id',
    ];

    /**
     * Gets the folder.
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
