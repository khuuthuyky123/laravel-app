<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('layouts.app1');
})->middleware('verified');

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('profile', ProfileController::class)->middleware('verified');
Route::resource('users', UserController::class)->middleware('verified');

Route::post('/userinfo', function () {
    return response([
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'role_id' => Auth::user()->role_id,
    ], 200);
});
