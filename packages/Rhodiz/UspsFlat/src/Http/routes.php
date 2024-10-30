<?php

use Illuminate\Support\Facades\Route;
use Rhodiz\UspsFlat\Http\Controllers\AddressController;

Route::group(['middleware' => ['web']], function () {
    Route::post('address-validation', [AddressController::class, 'addressValidation'])->name('rhodiz.usps.addresses.validate');
});
