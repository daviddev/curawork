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
Route::get('/connections/counts', [\App\Http\Controllers\ConnectionController::class, 'countConnectionsByType']);
Route::post('/connections/common', [\App\Http\Controllers\ConnectionController::class, 'commonConnections']);
Route::resource('/connections', \App\Http\Controllers\ConnectionController::class);
