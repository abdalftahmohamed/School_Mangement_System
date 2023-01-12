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

});


require __DIR__.'/auth.php';
