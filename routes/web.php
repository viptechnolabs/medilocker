<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:hospital,web', 'checkStatus'])->group(function () {

    Route::get('/', [\App\Http\Controllers\HospitalController::class, 'index'])->name('index');

    /* Hospital, Doctor and User Middleware */
    Route::get('/', [\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
    Route::post('email/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getEmailPopup'])->name('email.popup.get');
    Route::post('mobile/popup/{user}', [\App\Http\Controllers\HospitalController::class, 'getMobilePopup'])->name('mobile.popup.get');

    /* Check email,mobile and password route */
    Route::prefix('check')->as('check.')->group(function () {
        Route::post('email', [\App\Http\Controllers\HospitalController::class, 'checkEmail'])->name('email');
        Route::post('mobile', [\App\Http\Controllers\HospitalController::class, 'checkMobile'])->name('mobile');
        Route::post('password', [\App\Http\Controllers\HospitalController::class, 'checkPassword'])->name('password');
    });

});


/* login route */
Route::get('login', [\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
Route::post('doLogin', [\App\Http\Controllers\HospitalController::class, 'doLogin'])->name('doLogin');
Route::get('logout', [\App\Http\Controllers\HospitalController::class, 'logout'])->name('logout');

/* Get city route */
Route::post('getCities', [\App\Http\Controllers\HospitalController::class, 'fetchCities'])->name('fetchCities');
