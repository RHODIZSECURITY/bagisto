<?php

use Illuminate\Support\Facades\Route;
use Rhodiz\Config\Http\Controllers\ConfigController;

Route::group(['middleware' => ['web'], 'prefix' => config('app.admin_url')], function () {
    Route::controller(ConfigController::class)->group(function () {
        Route::get('/mail-preview-list', 'index')->name('rhodiz.config.mail_index');
        Route::get('/mail-preview-show', 'preview')->name('rhodiz.config.mail_preview');
    });
});
