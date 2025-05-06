<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLogController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/req', [MentorController::class, 'req'])->name('req');
Route::post('/req', [MentorController::class, 'store'])->name('confirms.store');
Route::put('/confirms/update', [MentorController::class, 'update'])->name('confirms.update');

Route::post('/approve-mentor', [AdminController::class, 'approveMentor'])->name('approve.mentor');

Route::post('/mentor/signature/update/{id}', [MentorController::class, 'updateSignature'])->name('mentor.signature.update');

Route::post('/mentor/comment/update', [MentorController::class, 'updateComment'])->name('mentor.comment.update');

Route::group(['prefix' => 'location'], function () {
    Route::get('index', [LocationController::class, 'index'])->name('location.index');
    Route::post('addstore', [LocationController::class, 'store'])->name('location.store');
});

Route::group(['prefix' => 'student'], function () {
    Route::get('index', [StudentController::class, 'index'])->name('student.index');
    Route::post('/upload-image', [StudentController::class, 'uploadImage'])->name('student.uploadImage');
});

Route::post('/student/upload-image', [StudentController::class, 'uploadImage'])->name('student.uploadImage');

Route::get('/create-student-images-folder', function () {
    $path = public_path('student_images');
    if (!File::exists($path)) {
        File::makeDirectory($path, 0755, true);
    }
    return 'Folder created successfully!';
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'edit'], function () {
        Route::get('users', [AdminController::class, 'users'])->name('user.index');
        Route::post('update-role', [AdminController::class, 'edit'])->name('users.updateRole');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/student/log', [StudentLogController::class, 'index'])->name('student.log');
    Route::post('/student/log', [StudentLogController::class, 'store'])->name('student.log.store');
    Route::put('/student/log/update', [StudentLogController::class, 'update'])->name('student.log.update');
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
});

Route::post('/teacher/comment/update', [TeacherController::class, 'updateComment'])->name('teacher.comment.update');
