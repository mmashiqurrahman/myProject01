<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;

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

Route::get('/', function() {
    return view('homepage');
})->name('homepage');

Route::get('/role-list', [RoleController::class, 'index'])->name('role.list');
Route::get('/add-role', [RoleController::class, 'create'])->name('role.create');
Route::post('/add-role', [RoleController::class, 'store'])->name('role.store');

Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegisterUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');


Route::get('/user-list', [UserController::class, 'index'])->name('user.list');
Route::get('/get-users', [UserController::class, 'getUsers'])->name('get.users');


Route::get('/post-list', [PostController::class, 'index'])->name('post.list');


Route::middleware(['authfast'])->group(function() {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/add-post', [PostController::class, 'create'])->name('post.create');
    Route::post('/add-post', [PostController::class, 'store'])->name('post.store');

    Route::get('/post-details/{id}', [PostController::class, 'show'])->name('post.details');

    Route::get('/add-comment/{post_id}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/add-comment', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/change-image', [UserController::class, 'changeImage'])->name('change.image');
    Route::post('/change-image', [UserController::class, 'updateImage'])->name('update.image');
    Route::get('/download-image', [UserController::class, 'downloadImage'])->name('download.image');
});





