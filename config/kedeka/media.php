<?php

// config for Kedeka/Setting
return [
    'disk' => 'public',
    'middleware' => [
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ],
    'models' => [
        'attachment' => \Kedeka\Media\Models\Attachment::class,
        'file' => \Kedeka\Media\Models\File::class,
    ],
];
