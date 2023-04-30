<?php

use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PaymentStudentController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teacher\Teachercontroller;
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
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    //==============================dashboard============================
    Route::group([], function () {
        Route::resource('Grades', GradeController::class);
    });

    //==============================Classrooms============================
    Route::group([], function () {
        Route::resource('Classrooms', ClassroomController::class);
        Route::DELETE('destroyall', [ClassroomController::class,'destroyall'])->name('destroyall');
        Route::post('filter_classes', [ClassroomController::class,'filter_classes'])->name('filter_classes');

    });

    //==============================Sections============================
    Route::group([], function () {
        Route::resource('Sections', SectionController::class);
        Route::get('/classes/{id}', [SectionController::class,'getclasses']);
    });


    //==============================livewire_parents============================

    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    //==============================Teachers=====================================
    Route::group([], function () {
        Route::resource('Teachers', TeacherController::class);
    });
    //==============================Students=====================================
    Route::group([], function () {
        Route::resource('Students', StudentController::class);
        Route::resource('Graduated', GraduatedController::class);
        Route::resource('Promotion', PromotionController::class);
        Route::resource('Fees', FeesController::class);
        Route::resource('Fees_Invoices', FeeInvoiceController::class);
        Route::resource('receipt_students', ReceiptStudentController::class);
        Route::resource('ProcessingFee', ProcessingFeeController::class);
        Route::resource('Payment_students', PaymentStudentController::class);
        Route::resource('Attendance', AttendanceController::class);
        Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
        Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');
    });

});


require __DIR__.'/auth.php';
