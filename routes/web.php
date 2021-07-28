<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UpdateController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
Route::post('/tweet', [TweetController::class, 'store'])->name('tweet');
Route::get('/{user}', [UserController::class, 'index'])->name('user');
Route::post('/{user}', [UserController::class, 'tooltip']);
Route::get('/profile/update', [UpdateController::class, 'index'])->name('update');
Route::post('/{user}/follow', [FollowController::class, 'store']);
Route::post('/tweet/like', [LikeController::class, 'store']);
Route::post('/tweet/delete', [LikeController::class, 'delete']);
Route::post('/profile/update/save', [UpdateController::class, 'update'])->name('update_profile');
