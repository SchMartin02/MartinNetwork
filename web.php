<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\adminController;

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
Auth::routes();

Route::group(['middleware' => 'web'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/user', [OnlineController::class, 'index'])->name('user');

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/profile', [profileController::class, 'show'])->name('profile');

    Route::get('/profile/image', [Controller::class, 'imageupload']);

    Route::post('/profile/image', [Controller::class, 'store']);

    Route::post('/profile', [profileController::class, 'store']);

    Route::get('/users', [usersController::class, 'show']);

    Route::get('/project', [projectController::class, 'show']);

    Route::get('/settings', [settingController::class, 'show']);

    Route::resource('adminuser', adminController::class);

    Route::get('/adminuser', [adminController::class, 'adminUser'])->name('adminUser');

    Route::get('/adminuser/{id}', [adminController::class, 'show']);

});
