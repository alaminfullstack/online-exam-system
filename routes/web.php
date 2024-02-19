<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExaminerController;
use App\Http\Controllers\QuestionController;

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

Route::get('login', [AdminController::class, 'login'])->name('login');
Route::post('login', [AdminController::class, 'save_login'])->name('save_login');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // exam
        Route::resource('exams', ExamController::class)->names('exams');

        // exam
        Route::resource('banners', BannerController::class)->names('banners');

        // questions
        Route::resource('questions', QuestionController::class)->names('questions');

        // examiners
        Route::resource('examiners', ExaminerController::class)->names('examiners');

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
