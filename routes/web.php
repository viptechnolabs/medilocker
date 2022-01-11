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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware(['auth:hospital,web', 'checkStatus'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HospitalController::class, 'index'])->name('index');
});

# login route
Route::get('login', [\App\Http\Controllers\HospitalController::class, 'login'])->name('login');
Route::post('doLogin', [\App\Http\Controllers\HospitalController::class, 'doLogin'])->name('doLogin');
Route::get('logout', [\App\Http\Controllers\HospitalController::class, 'logout'])->name('logout');

Route::post('getCities', [\App\Http\Controllers\HospitalController::class, 'fetchCities'])->name('fetchCities');
