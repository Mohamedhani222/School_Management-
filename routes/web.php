<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::group(
    ['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // grades
    Route::resource('grades', GradeController::class);

    // classrooms
    Route::resource('classes', ClassroomController::class);
    Route::post('deleteAll', [ClassroomController::class, 'deleteAll'])->name('delete_all');
    Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');

    // sections
    Route::resource('Sections', SectionController::class);
    Route::get('Sections/classes/{id}', [SectionController::class, 'getclasses']);

    // parents
    Route::view('add-parent', 'livewire.Show_Form');

    //Teachers
    Route::resource('teachers', TeacherController::class);

    // Students
    Route::resource('students', StudentController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('graduated' , \App\Http\Controllers\Students\GraduatedController::class);
    Route::get('Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
    Route::get('Get_Sections/{id}', [StudentController::class, 'Get_sections']);

    Route::group(['prefix' => 'students'], function () {
        Route::get('/export/', [StudentController::class, 'export_students'])->name('export');
        Route::post('/upload_attachment', [StudentController::class, 'add_attachment'])->name('Upload_attachment');
        Route::get('/download_attachment/{studentsname}/{filename}', [StudentController::class, 'download_attachment'])->name('download_attachment');
        Route::post('/delete_attachment', [StudentController::class, 'delete_attachment'])->name('delete_attachment');
        // Students Promotions
    });



});


Auth::routes();



