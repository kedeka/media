<?php

namespace Kedeka\Media\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    /**
     * @return mixed
     */
    public function upload(UploadedFile $file, string|null $disk = null)
    {
        $disk = $disk ?: config('kedeka.media.disk', 'public');
        $path = $file->store('media', $disk);
        /** @var Storage $storage */
        $storage = Storage::disk($disk);

        $media = app(config('kedeka.media.models.file'))->create([
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'disk' => $disk,
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'url' => $storage->url($path),
        ]);

        return $media;
    }
}
