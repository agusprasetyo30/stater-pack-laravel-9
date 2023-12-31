<?php

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
    if (auth()->user()) {
        return redirect()->route('home');
    }

    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('home', function() {
        return view('dashboard.home');
    })->name('home');

    Route::get('/edit-profile', function() {
        return view('dashboard.profile');
    })->name('profile.edit');

    Route::resource('user', UserController::class);
});