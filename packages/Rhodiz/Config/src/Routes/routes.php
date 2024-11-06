<?php

use Illuminate\Support\Facades\Route;
use Rhodiz\Config\Http\Controllers\ConfigController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {
    Route::controller(ConfigController::class)->group(function () {
        Route::get('/rhodiz_config', 'index')->name('rhodiz_config.index');
    });
});
