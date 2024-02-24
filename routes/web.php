<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExaminerController;
use App\Http\Controllers\FrontendController;
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
        Route::get('/profile-setting', [AdminController::class, 'profile_setting'])->name('profile_setting');
        Route::post('/update-profile', [AdminController::class, 'update_profile'])->name('update_profile');

        // exam
        Route::resource('exams', ExamController::class)->names('exams');

        // exam
        Route::resource('banners', BannerController::class)->names('banners');

        // questions
        Route::resource('questions', QuestionController::class)->names('questions');

        // examiners
        Route::get('examiners', [ExaminerController::class, 'index'])->name('examiners.index');
        Route::get('export-examiners', [ExaminerController::class, 'export'])->name('examiners.export');

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

// online-exam
Route::get('online-exam/{slug}', [FrontendController::class, 'online_exam'])->name('online_exam');
Route::post('online-exam/{slug}', [FrontendController::class, 'online_exam_submit'])->name('online_exam_submit');
Route::get('result/{slug}/examiner/{examiner}', [FrontendController::class, 'result'])->name('result');
Route::get('result-details/{slug}/examiner/{examiner}', [FrontendController::class, 'result_details'])->name('result_details');
