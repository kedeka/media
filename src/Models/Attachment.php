<?php

namespace Kedeka\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Kedeka\Support\Database\Concerns\UlidAsPrimary;

/**
 * Kedeka\Media\Models\Attachment.
 *
 * @property string $ulid
 * @property string $tag
 * @property string $order_column
 * @property string $attachable_type
 * @property mixed $attachable_id
 * @property File $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Attachment extends Model
{
    use UlidAsPrimary;

    protected $table = 'media_attachments';

    protected $fillable = [
        'tag',
        'order_column',
        'file_id',
        'attachable_type',
        'attachable_id',
    ];

    public $timestamps = false;

    public function file()
    {
        return $this->belongsTo(config('kedeka.media.models.file'));
    }

    public function attachable()
    {
        return $this->morphTo();
    }
}
