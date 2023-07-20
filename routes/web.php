<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, "showLoginForm"])->name('login');
    Route::post('/login_process', [AuthController::class, "login"])->name('login_process');

    Route::get('/register', [AuthController::class, "showRegisterForm"])->name('register');
    Route::post('/register_process', [AuthController::class, "register"])->name('register_process');
});

Route::middleware("auth")->group(function () {
    Route::get('/', [IndexController::class, "index"])->name('home');

    Route::get('/task/new', [IndexController::class, "new"])->name('task.new');
    Route::post('/task/new_process', [TaskController::class, "create"])->name('task.new_process');

    Route::post('/task/delete/{id}', [TaskController::class, "delete"])->name('task.delete_process');

    Route::get('/logout', [AuthController::class, "logout"])->name('logout');
});