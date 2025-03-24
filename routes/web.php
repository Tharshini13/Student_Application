<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// User Management Routes
Route::get('/users', [UserController::class, 'loadAllUsers']);
Route::get('/add/user', [UserController::class, 'loadAddUserForm']);
Route::post('/add/user', [UserController::class, 'AddUser'])->name('AddUser');
Route::get('/edit/{id}', [UserController::class, 'loadEditForm']);
Route::post('/edit/user', [UserController::class, 'EditUser'])->name('EditUser');
Route::get('/delete/{id}', [UserController::class, 'deleteUser']);

// Authentication Routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
