<?php


use App\Http\Controllers\Teacher\dashboard\ProfileController;
use App\Http\Controllers\Teacher\dashboard\QuestionController;
use App\Http\Controllers\Teacher\dashboard\QuizzController;
use App\Http\Controllers\Teacher\dashboard\StudentController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections'] = $ids->count();
        $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();

//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard.dashboard', $data);
    });


    //==============================students============================
    Route::resource('student', StudentController::class);
    Route::get('sections', [StudentController::class, 'sections'])->name('sections');
    Route::post('attendance', [StudentController::class, 'attendance'])->name('attendance');
//  Route::post('edit_attendance',[StudentController::class,'editAttendance'])->name('attendance.edit');
    Route::get('attendance_report', [StudentController::class, 'attendanceReport'])->name('attendance.report');
    Route::post('attendance_report', [StudentController::class, 'attendanceSearch'])->name('attendance.search');
    Route::resource('quizzes', QuizzController::class);
    Route::resource('questions', QuestionController::class);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::post('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
//    Route::get('Calendar/{id}',[\App\Http\Livewire\Calendar::class,'delete'])->name('Calendar');



});
