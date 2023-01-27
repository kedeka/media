<?php

namespace Kedeka\Media\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    /**
     * @param  Model  $model
     * @param  string  $attribute
     * @param  UploadedFile  $file
     * @return mixed
     */
    public function upload(Model $model, string $attribute, UploadedFile $file)
    {
        tap($model->{$attribute}, function ($previous) use ($model, $attribute, $file) {
            $disk = config('kedeka.media.disk', 'public');
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

            $media->attachedTo($model, $attribute);

            if ($previous) {
                Storage::disk($previous->file->disk)->delete($previous->file->path);
                $previous->file()->delete();
                $previous->delete();
            }
        });

        return $model->{$attribute};
    }
}
