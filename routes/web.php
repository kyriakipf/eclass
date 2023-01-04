<?php

use App\Http\Controllers\Admin\AdminSendEmailController;
use App\Http\Controllers\Admin\ImportExcelStudentController;
use App\Http\Controllers\Admin\ImportExcelTeacherController;
use App\Http\Controllers\Admin\InviteStudentController;
use App\Http\Controllers\Admin\InviteTeacherController;
use App\Http\Controllers\Admin\SearchStudentController;
use App\Http\Controllers\Admin\SearchTeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teachers\EmailController;
use App\Http\Controllers\Teachers\GroupController;
use App\Http\Controllers\Teachers\HomeworkController;
use App\Http\Controllers\Teachers\InfoController;
use App\Http\Controllers\Teachers\SearchEmailController;
use App\Http\Controllers\Teachers\SearchGroupController;
use App\Http\Controllers\Teachers\SearchHomeworkController;
use App\Http\Controllers\Teachers\SearchSubjectController;
use App\Http\Controllers\Teachers\SubjectController;
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

//Password
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
        Route::post('{user}/update', [TeacherController::class, 'update'])->name('teacher.update');
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
    Route::group(['prefix' => 'email'], function() {
        Route::get('create', [AdminSendEmailController::class, 'create'])->name('admin.email.create');
        Route::get('index', [AdminSendEmailController::class, 'index'])->name('admin.email');
        Route::get('send', [AdminSendEmailController::class, 'process'])->name('admin.email.process');
        Route::get('{email}/show', [EmailController::class, 'show'])->name('admin.email.show');
        Route::get('{email}/delete', [EmailController::class, 'delete'])->name('admin.email.delete');
    });
    Route::group(['prefix' => 'subject'], function (){
        Route::get('index', [App\Http\Controllers\Admin\SubjectController::class , 'index'])->name('admin.subjects');
    Route::get('{subject}/show', [App\Http\Controllers\Admin\SubjectController::class, 'show'])->name('admin.subject.show');
    Route::get('{subject}/directory/{folder}/show', [App\Http\Controllers\Admin\SubjectController::class, 'directoryShow'])->name('admin.subject.directory.show');
        Route::get('{subject}/file/{file}/download', [App\Http\Controllers\Admin\SubjectController::class, 'fileDownload'])->name('admin.subject.file.download');
    });
    Route::get('template/{name}/download', [\App\Http\Controllers\DownloadTemplateController::class, 'downloadTemplate'])->name('template.download');

});


//Teacher
Route::group(['prefix' => 'teacher', 'middleware' => ['auth']], function() {

    //Subject Management
    Route::group(['prefix' => 'subject'], function (){
        Route::get('index', [SubjectController::class , 'index'])->name('subjects');
        Route::get('create', [SubjectController::class, 'create'])->name('subject.create');
        Route::post('store', [SubjectController::class, 'store'])->name('subject.store');
        Route::get('{subject}/show', [SubjectController::class, 'show'])->name('subject.show');
        Route::get('{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
        Route::post('{subject}/update', [SubjectController::class, 'update'])->name('subject.update');
        Route::get('{subject}/delete', [SubjectController::class, 'delete'])->name('subject.delete');
        Route::get('{subject}/directory/create', [SubjectController::class, 'directoryCreate'])->name('subject.directory.create');
        Route::post('{subject}/directory/store', [SubjectController::class, 'directoryStore'])->name('subject.directory.store');
        Route::get('{subject}/subdirectory/{folder}/create', [SubjectController::class, 'subDirectoryCreate'])->name('subject.subdirectory.create');
        Route::post('{subject}/subdirectory/{folder}/store', [SubjectController::class, 'subDirectoryStore'])->name('subject.subdirectory.store');
        Route::get('{subject}/directory/{folder}/show', [SubjectController::class, 'directoryShow'])->name('subject.directory.show');
        Route::post('{subject}/file/store/{folder?}', [SubjectController::class, 'fileStore'])->name('subject.file.store');
        Route::get('{subject}/file/upload/{folder?}', [SubjectController::class, 'fileUpload'])->name('subject.file.upload');
        Route::get('{subject}/file/{file}/download', [SubjectController::class, 'fileDownload'])->name('subject.file.download');
        Route::match(['get', 'post'],'/search/form', [SearchSubjectController::class, 'search'])->name('subject.search.form');
    });

    //Group Management
    Route::group(['prefix' => 'group'], function (){
        Route::get('index', [GroupController::class, 'index'])->name('groups');
        Route::get('create/{subject?}', [GroupController::class, 'create'])->name('group.create');
        Route::post('store', [GroupController::class, 'store'])->name('group.store');
        Route::get('{group}/show', [GroupController::class, 'show'])->name('group.show');
        Route::get('{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
        Route::post('{group}/update', [GroupController::class, 'update'])->name('group.update');
        Route::get('{group}/delete', [GroupController::class, 'delete'])->name('group.delete');
        Route::match(['get', 'post'],'/search/form', [SearchGroupController::class, 'search'])->name('group.search.form');
    });

    //Homework Management
    Route::group(['prefix' => 'homework'], function(){
       Route::get('index', [HomeworkController::class, 'index'])->name('homework');
       Route::get('create', [HomeworkController::class, 'create'])->name('homework.create');
       Route::post('store', [HomeworkController::class, 'store'])->name('homework.store');
       Route::get('{homework}/show', [HomeworkController::class, 'show'])->name('homework.show');
       Route::get('{homework}/edit', [HomeworkController::class, 'edit'])->name('homework.edit');
       Route::post('{homework}/update', [HomeworkController::class, 'update'])->name('homework.update');
       Route::get('{homework}/delete', [HomeworkController::class, 'delete'])->name('homework.delete');
        Route::get('{homework}/file/delete', [HomeworkController::class, 'deleteFile'])->name('homework.file.delete');
        Route::get('{homework}/file/download', [HomeworkController::class, 'fileDownload'])->name('homework.file.download');
        Route::match(['get', 'post'],'/search/form', [SearchHomeworkController::class, 'search'])->name('homework.search.form');
    });

    //Email
    Route::group(['prefix' => 'email'], function(){
        Route::get('index', [EmailController::class, 'index'])->name('teacher.email');
        Route::get('create', [EmailController::class, 'create'])->name('teacher.email.create');
        Route::get('send', [EmailController::class, 'process'])->name('teacher.email.process');
        Route::get('{email}/show', [EmailController::class, 'show'])->name('teacher.email.show');
        Route::get('{email}/delete', [EmailController::class, 'delete'])->name('teacher.email.delete');
        Route::match(['get', 'post'],'/search/form', [SearchEmailController::class, 'search'])->name('teacher.email.search.form');
    });

    //Info
    Route::get('info', [InfoController::class, 'show'])->name('teacher.info.show');
    Route::get('info/edit', [InfoController::class, 'edit'])->name('teacher.info.edit');
    Route::post('info/update', [InfoController::class, 'update'])->name('teacher.info.update');

});


//Student
Route::group(['prefix' => 'student', 'middleware' => ['auth']], function(){

    //Info
    Route::group(['prefix' => 'info'], function(){
        Route::get('/', [App\Http\Controllers\Students\InfoController::class, 'show'])->name('student.info.show');
        Route::get('/edit', [App\Http\Controllers\Students\InfoController::class, 'edit'])->name('student.info.edit');
        Route::post('/update', [App\Http\Controllers\Students\InfoController::class, 'update'])->name('student.info.update');
    });

    //Subject
    Route::group(['prefix' => 'subject'], function(){
        Route::get('/', [App\Http\Controllers\Students\SubjectController::class, 'index'])->name('student.subjects');
        Route::get('/all', [App\Http\Controllers\Students\SubjectController::class, 'getAll'])->name('student.subject.all');
        Route::get('/register/form', [App\Http\Controllers\Students\SubjectController::class, 'registerForm'])->name('student.subject.register.form');
        Route::post('/{subject}/register', [App\Http\Controllers\Students\SubjectController::class, 'register'])->name('student.subject.register');
        Route::get('{subject}/show', [App\Http\Controllers\Students\SubjectController::class, 'show'])->name('student.subject.show');
        Route::get('{subject}/directory/{folder}/show', [App\Http\Controllers\Students\SubjectController::class, 'directoryShow'])->name('student.subject.directory.show');
        Route::get('{subject}/file/{file}/download', [App\Http\Controllers\Students\SubjectController::class, 'fileDownload'])->name('student.subject.file.download');
    });

});



require __DIR__.'/auth.php';
