<?php

namespace Kedeka\Media\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AttachFile
{
    /**
     * @return mixed
     */
    public function attach(Model $model, string $attribute, UploadedFile $file)
    {
        tap($model->{$attribute}, function ($previous) use ($model, $attribute, $file) {
            $media = (new UploadFile)->upload($file);

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
