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

/* Hospital, Doctor and Staff middleware */
Route::middleware(['auth:hospital,web', 'checkStatus'])->group(function () {

    Route::get('/', [\App\Http\Controllers\HospitalController::class, 'index'])->name('index');

    /* Email, mobile change popup route */
    Route::post('email/popup/{user}', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'getEmailPopup'])->name('email.popup.get');
    Route::post('mobile/popup/{user}', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'getMobilePopup'])->name('mobile.popup.get');

    /* Check email,mobile and password route */
    Route::prefix('check')->as('check.')->group(function () {
        Route::post('email', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'checkEmail'])->name('email');
        Route::post('mobile', [\App\Http\Controllers\HospitalController::class, 'checkMobile'])->name('mobile');
        Route::post('password', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'checkPassword'])->name('password');
    });

    /* */
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::post('update/email', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'updateEmail'])->name('update.email');
        Route::post('update/emailVerificationCode', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'emailVerificationCode'])->name('update.emailVerificationCode');
        Route::post('update/mobile_no', [\App\Http\Controllers\HospitalController::class, 'hospitalUpdateMobileNo'])->name('update.mobile');
        Route::post('update/mobile_verification_code', [\App\Http\Controllers\HospitalController::class, 'mobile_verification_code'])->name('update.mobile_verification_code');
    });

    /* Change password */
    Route::put('changePassword', [\App\Http\Controllers\UpdateMobileEmailPasswordController::class, 'changePassword'])->name('changePassword');

});

/* Hospital middleware */
Route::middleware(['auth:hospital', 'checkStatus'])->group(function () {
    Route::get('hospitalDetails', [\App\Http\Controllers\HospitalController::class, 'hospitalDetails'])->name('hospitalDetails');
    Route::put('hospitalDetailsUpdate', [\App\Http\Controllers\HospitalController::class, 'hospitalDetailsUpdate'])->name('hospitalDetailsUpdate');
});

/* Doctor and staff middleware */
Route::middleware(['auth:web', 'checkStatus'])->group(function () {
    Route::get('profile', [App\Http\Controllers\HospitalController::class, 'profile'])->name('profile');
});

/* login route */
Route::get('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('doLogin', [\App\Http\Controllers\LoginController::class, 'doLogin'])->name('doLogin');
Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

/* Get city route */
Route::post('getCities', [\App\Http\Controllers\HospitalController::class, 'fetchCities'])->name('fetchCities');
