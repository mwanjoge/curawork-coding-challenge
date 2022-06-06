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
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loader', [App\Http\Controllers\HomeController::class, 'getLoader'])->name('loader');
Route::get('/suggestions', [App\Http\Controllers\HomeController::class, 'suggestions'])->name('suggestions');
Route::get('/connections', [App\Http\Controllers\UserConnectionController::class, 'index'])->name('connectinons');
Route::get('/ajax/requests/{mode}', [App\Http\Controllers\UserRequestController::class, 'index'])->name('user.request.index');
Route::get('/delete/request/{id}', [App\Http\Controllers\UserRequestController::class, 'destroy'])->name('request.destroy');
Route::post('/send/request/{id}', [App\Http\Controllers\UserRequestController::class, 'store'])->name('suggestion.request');
