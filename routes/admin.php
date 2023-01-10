<?php

use Illuminate\Support\Facades\Route;
use Kedeka\Media\Controllers\DestroyController;

Route::middleware(array_merge([
    'web',
], config('kedeka.middleware', []))
)
->name('kedeka::media')
->group(function () {
    Route::delete('/media/{file}', DestroyController::class)->name('.destroy');
});
