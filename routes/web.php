<?php

use App\Http\Controllers\ProfileController;
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
        Route::resource('Classrooms', '\App\Http\Controllers\ClassroomController');
    });



});


require __DIR__.'/auth.php';
