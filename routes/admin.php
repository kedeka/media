<?php

use Illuminate\Support\Facades\Route;

Route::middleware(array_merge([
    'web',
], config('kedeka.admin.middleware', []))
)
->domain(config('kedeka.admin.domain'))
->prefix(config('kedeka.admin.path'))
->name('kedeka::admin')
->group(function () {
    Route::prefix('media')->name('.media.')->group(function () {
    });
});
