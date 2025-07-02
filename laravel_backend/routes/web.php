<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\TestApiController;


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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register_post', [LoginController::class, 'register_post'])->name('register_post');

Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/user/{id}', [LoginController::class, 'getUser']);

Route::get('/test-web', function () {
    return 'web route ok';
});

Route::get('/test-api-file', function () {
    return file_exists('/tmp/api-routes-loaded.txt') ? 'api loaded' : 'api not loaded';
});