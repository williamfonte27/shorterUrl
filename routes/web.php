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
    return view('home');
})->name('home');


Route::get('/most', [\App\Http\Controllers\ShortLinkController::class, 'index'])->name('most-viewed');
Route::get('/{short}', [\App\Http\Controllers\ShortLinkController::class, 'show'])->name('show-short-link');

Route::resource('/short-link', \App\Http\Controllers\ShortLinkController::class);
