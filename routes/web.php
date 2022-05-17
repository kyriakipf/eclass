<?php

use App\Http\Controllers\AdminSendEmailController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportExcelStudentController;
use App\Http\Controllers\ImportExcelTeacherController;
use App\Http\Controllers\InviteStudentController;
use App\Http\Controllers\InviteTeacherController;
use App\Http\Controllers\SearchStudentController;
use App\Http\Controllers\SearchTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
//Login and Password manage

Route::get('/', function () {return view('auth.login');});
Route::get('signout', [CustomAuthController::class, 'signout'])->middleware(['auth'])->name('signout');
Route::get('dashboard',[DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('change/password/view', [CustomAuthController::class, 'changePasswordView'])->middleware(['auth'])->name('change.password.view');
Route::post('change/password/store', [CustomAuthController::class, 'changePassword'])->middleware(['auth'])->name('change.password.store');

//Invites

Route::post('{invite}/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
Route::post('{invite}/student/store', [StudentController::class, 'store'])->name('student.store');

//Admin
Route::group(['prefix' => 'admin' , 'middleware' => ['auth']], function () {
    //Admin Teacher Management
    Route::group(['prefix' => 'teacher'],function(){
        Route::get('index', [TeacherController::class, 'index'])->name('teachers');
        Route::get('create', [TeacherController::class, 'create'])->name('teacher.create');

        Route::get('{teacher}/show', [TeacherController::class, 'show'])->name('teacher.show');
        Route::get('{teacher}/invite/show', [InviteTeacherController::class, 'show'])->name('teacher.invite.show');
        Route::post('{teacher}/update', [TeacherController::class, 'update'])->name('teacher.update');
        Route::post('{teacher}/invite/update', [InviteTeacherController::class, 'update'])->name('teacher.invite.update');
        Route::get('{teacher}/delete', [TeacherController::class, 'delete'])->name('teacher.delete');
        Route::get('{teacher}/invite/delete', [InviteTeacherController::class, 'delete'])->name('teacher.invite.delete');

        Route::post('invite/import', [ImportExcelTeacherController::class, 'import'])->name('teacher.import');

        Route::get('/mass/invite', [InviteTeacherController::class, 'massProcess'])->name('teacher.mass.process');
        Route::get('invite', [InviteTeacherController::class, 'invite'])->name('teacher.invite');
        Route::post('invite/store', [InviteTeacherController::class, 'store'])->name('teacher.invite.store');
        Route::get('{teacher}/invite', [InviteTeacherController::class, 'process'])->name('teacher.process');
        Route::get('accept/{token}', [InviteTeacherController::class, 'accept'])->name('teacher.accept');
        Route::get('/search', [SearchTeacherController::class, 'searchIndex'])->name('teacher.search');
        Route::match(['get', 'post'],'/search/form', [SearchTeacherController::class, 'search'])->name('teacher.search.form');
    });
    Route::group(['prefix' => 'student'], function(){
        Route::get('index', [StudentController::class, 'index'])->name('students');
        Route::get('create', [StudentController::class, 'create'])->name('student.create');

        Route::get('{student}/show', [StudentController::class, 'show'])->name('student.show');
        Route::get('{student}/invite/show', [InviteStudentController::class, 'show'])->name('student.invite.show');
        Route::post('{student}/update', [StudentController::class, 'update'])->name('student.update');
        Route::post('{student}/invite/update', [InviteStudentController::class, 'update'])->name('student.invite.update');
        Route::get('{student}/delete', [StudentController::class, 'delete'])->name('student.delete');
        Route::get('{student}/invite/delete', [InviteStudentController::class, 'delete'])->name('student.invite.delete');

        Route::post('invite/import', [ImportExcelStudentController::class, 'import'])->name('student.import');

        Route::post('invite/store', [InviteStudentController::class, 'store'])->name('student.invite.store');
        Route::get('/mass/invite', [InviteStudentController::class, 'massProcess'])->name('student.mass.process');
        Route::get('invite', [InviteStudentController::class, 'invite'])->name('student.invite');
        Route::get('{student}/invite', [InviteStudentController::class, 'process'])->name('student.process');
        Route::get('accept/{token}', [InviteStudentController::class, 'accept'])->name('student.accept');
        Route::get('/search', [SearchStudentController::class, 'searchIndex'])->name('student.search');
        Route::match(['get', 'post'],'/search/form', [SearchStudentController::class, 'search'])->name('student.search.form');
    });

    Route::get('email', [AdminSendEmailController::class, 'index'])->name('email');
    Route::get('email/send', [AdminSendEmailController::class, 'process'])->name('email.process');

    Route::get('template/{name}/download', [\App\Http\Controllers\DownloadTemplateController::class, 'downloadTemplate'])->name('template.download');

});




require __DIR__.'/auth.php';
