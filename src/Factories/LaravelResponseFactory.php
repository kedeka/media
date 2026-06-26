<?php

namespace Kedeka\Media\Factories;

use Illuminate\Http\Response;
use League\Flysystem\FilesystemOperator;
use League\Glide\Responses\ResponseFactoryInterface;

class LaravelResponseFactory implements ResponseFactoryInterface
{
    public function create(FilesystemOperator $cache, string $path): Response
    {
        $contentType = $cache->mimeType($path);
        $contentLength = (string) $cache->fileSize($path);
        $cacheControl = 'max-age=31536000, public';
        $expires = date_create('+1 years')->format('D, d M Y H:i:s').' GMT';

        return new Response($cache->read($path), 200, [
            'Content-Type' => $contentType,
            'Content-Length' => $contentLength,
            'Cache-Control' => $cacheControl,
            'Expires' => $expires,
        ]);
    }
}
