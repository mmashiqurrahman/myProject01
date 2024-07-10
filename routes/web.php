<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\GuestPageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegisterUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');


Route::get('/user-list', [UserController::class, 'index'])->name('user.list');

Route::middleware([EnsureUserIsAuthenticated::class])->group(function() {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});





