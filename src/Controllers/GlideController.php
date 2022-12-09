<?php

namespace Kedeka\Media\Controllers;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Kedeka\Media\Factories\GlideFactory;
use League\Glide\Responses\LaravelResponseFactory;

class GlideController
{
    public function __invoke(Request $request, $path)
    {
        $disk = config('kedeka.media.disk', 'public');
        $filesystem = app(FilesystemManager::class)->disk($disk);

        $request->mergeIfMissing(['w' => 500, 'fm' => 'webp', 'q' => 75]);

        $server = GlideFactory::create([
            'response' => new LaravelResponseFactory($request),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.glide-cache',
            'path' => $path,
        ]);

        if ($request->get('cache') === 'false') {
            $server->deleteCache($path);
        }

        if ($server->sourceFileExists($path)) {
            return $server->getImageResponse($path, $request->all());
        } else {
            abort(404);
        }
    }
}
