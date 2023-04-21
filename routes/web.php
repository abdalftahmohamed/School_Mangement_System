<?php

use App\Http\Controllers\Classroom\ClassroomController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

    //==============================dashboard============================
    Route::get('/dashboard', '\App\Http\Controllers\HomeController@index')->name('dashboard');

    //==============================dashboard============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', '\App\Http\Controllers\Grades\GradeController');
    });

    //==============================Classrooms============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', '\App\Http\Controllers\Classroom\ClassroomController');
        Route::DELETE('destroyall', [ClassroomController::class,'destroyall'])->name('destroyall');
        Route::post('filter_classes', [ClassroomController::class,'filter_classes'])->name('filter_classes');

    });

    //==============================Sections============================
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', '\App\Http\Controllers\Section\SectionController');
        Route::get('/classes/{id}', '\App\Http\Controllers\Section\SectionController@getclasses');
    });


    //==============================livewire_parents============================

    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    //==============================Teachers=====================================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', '\App\Http\Controllers\Teacher\TeacherController');
    });
    //==============================Students=====================================
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', '\App\Http\Controllers\Students\StudentController');
        Route::resource('Graduated', '\App\Http\Controllers\Students\GraduatedController');
        Route::resource('Fees', '\App\Http\Controllers\Students\FeesController');
        Route::resource('Fees_Invoices', '\App\Http\Controllers\Students\FeeInvoiceController');
        Route::get('/Get_classrooms/{id}', '\App\Http\Controllers\Students\StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', '\App\Http\Controllers\Students\StudentController@Get_Sections');

        Route::post('Upload_attachment', '\App\Http\Controllers\Students\StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', '\App\Http\Controllers\Students\StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', '\App\Http\Controllers\Students\StudentController@Delete_attachment')->name('Delete_attachment');
    });

    //==============================Promotion Students ============================
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Promotion', '\App\Http\Controllers\Students\PromotionController');
    });

});


require __DIR__.'/auth.php';
