<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MentorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/req', [MentorController::class, 'req'])->name('req');
Route::post('/req', [MentorController::class, 'store'])->name('confirms.store');
Route::put('/confirms/update', [MentorController::class, 'update'])->name('confirms.update');


Route::post('/approve-mentor', [AdminController::class, 'approveMentor'])->name('approve.mentor');

Route::group(['prefix' => 'location'], function () {
    Route::get('add', [LocationController::class, 'add'])->name('location.add');
    Route::post('addstore', [LocationController::class, 'store'])->name('location.store');

    // Route::post('update-role', [LocationController::class, 'edit'])->name('users.updateRole');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'edit'], function () {
        Route::get('users', [AdminController::class, 'users'])->name('user.index');
        Route::post('update-role', [AdminController::class, 'edit'])->name('users.updateRole');
    });
});
