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


Route::get('/', [App\Http\Controllers\Staff\StaffController::class, 'index'])->name('index');
Route::get('addStaff', [App\Http\Controllers\Staff\StaffController::class, 'addStaff'])->name('addStaff');
Route::post('storeStaff', [App\Http\Controllers\Staff\StaffController::class, 'storeStaff'])->name('storeStaff');
Route::get('staffDetails/{id}', [App\Http\Controllers\Staff\StaffController::class, 'staffDetails'])->name('staffDetails');
Route::get('staffDelete/{id}', [App\Http\Controllers\Staff\StaffController::class, 'staffDelete'])->name('staffDelete');
Route::get('deletedStaff', [App\Http\Controllers\Staff\StaffController::class, 'deletedStaff'])->name('deletedStaff');
