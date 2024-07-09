<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\GuestPageController;

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

Route::post('/user-page-01', [UserPageController::class, 'userpage01'])->middleware(EnsureTokenIsValid::class)->name('user.page01');
Route::get('/user-page-02', [UserPageController::class, 'userpage02'])->middleware(EnsureTokenIsValid::class)->name('user.page02');
Route::get('/guest-page-01', [GuestPageController::class, 'guestpage01'])->name('guest.page01');
Route::post('/guest-page-01', [GuestPageController::class, 'guestpage01post'])->name('guest.page01.post');



