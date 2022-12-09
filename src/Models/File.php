<?php

namespace Kedeka\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Kedeka\Support\Database\Concerns\HasUlid;

/**
 * Kedeka\Media\Models\File.
 *
 * @property string $path
 * @property string $name
 * @property string $disk
 * @property string $mime
 * @property mixed $size
 * @property string $url
 * @property string $glide_url
 * @property HasMany $attachments
 * @property mixed $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class File extends Model
{
    use HasFactory, HasUlid;

    protected $table = 'media_files';

    protected $fillable = [
        'path',
        'name',
        'disk',
        'mime',
        'size',
        'url',
        'meta',
    ];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, fn ($query, $terms) => $query->where(function ($subquery) use ($terms) {
            $terms = '%'.$terms.'%';
            $subquery->where('name', 'LIKE', $terms);
            $subquery->orWhere('meta', 'LIKE', $terms);
        }))->when($filters['sort'] ?? null, function ($query, $sortBy) {
            if (count($params = explode(':', $sortBy)) === 2) {
                [$column, $direction] = $params;
            } else {
                [$column] = $params;
                $direction = 'asc';
            }

            $query->orderBy($column, $direction);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function getGlideUrlAttribute()
    {
        if (Str::startsWith($this->mime, 'image/')) {
            return route('kedeka::media.image', $this->path);
        } else {
            return $this->url;
        }
    }

    public function attachedTo(Model $model, $tag = null, $orderColumn = 0)
    {
        return $this->attachments()->create([
            'attachable_type' => $model->getMorphClass(),
            'attachable_id' => $model->getKey(),
            'tag' => $tag,
            'order_column' => $orderColumn,
        ]);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
