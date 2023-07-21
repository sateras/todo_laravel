<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
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
    
    Route::get('/', [TaskListController::class, "home"])->name('home');
    
    Route::get('/lists', [TaskListController::class, "index"])->name('list.index');
    Route::post('/lists/new', [TaskListController::class, "create"])->name('list.create');
    Route::post('/lists/{id}', [TaskListController::class, "update"])->name('list.update');
    Route::delete('/lists/{id}', [TaskListController::class, "delete"])->name('list.delete');

    Route::post('/tasks/new', [TaskController::class, "create"])->name('task.create');
    Route::post('/tasks/{id}', [TaskController::class, "update"])->name('task.update');
    Route::delete('/tasks/{id}', [TaskController::class, "delete"])->name('task.delete');

    Route::post('/tags/new', [TagController::class, "create"])->name('tag.create');
    Route::post('/tags/{id}', [TagController::class, "update"])->name('tag.update');
    Route::delete('/tags/{id}', [TagController::class, "delete"])->name('tag.delete');

    Route::get('/logout', [AuthController::class, "logout"])->name('logout');
});