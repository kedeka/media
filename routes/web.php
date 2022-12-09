<?php

use Illuminate\Support\Facades\Route;
use Kedeka\Media\Controllers\GlideController;

Route::get('/images/{path}', GlideController::class)
    ->where('path', '.*')
    ->name('kedeka::media.image');
