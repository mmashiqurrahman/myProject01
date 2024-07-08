<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
});

Route::get('/login', [LoginController::class, 'create'])->name('login1');
Route::post('/login', [LoginController::class, 'store'])->name('login2');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

