<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teachers\dashboard\QuizzController;
use App\Http\Controllers\Teachers\dashboard\ProfileController;
use App\Http\Controllers\Teachers\dashboard\QuestionController;
use App\Http\Controllers\Teachers\dashboard\OnlineZoomClassController;
use App\Http\Controllers\Teachers\dashboard\AttendenceReportController;

/*
|--------------------------------------------------------------------------
| API Routes
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

        $ids = Teacher::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
        $count_sections = $ids->count();
        $count_students = Student::whereIn('section_id', $ids)->count();
        return view('pages.teachers.dashboard.dashboard', compact('count_sections', 'count_students'));
    });

 

    Route::group(['namespace' => 'App\Http\Controllers\Teachers\dashboard'], function () {
        //==============================students============================
     Route::get('student',[AttendenceReportController::class, 'index'])->name('student.index');
     Route::get('section',[AttendenceReportController::class, 'sections'])->name('section.index');
     Route::post('attendances',[AttendenceReportController::class, 'attendance'])->name('attendances');
     Route::get('attendance_report',[AttendenceReportController::class, 'attendance_report'])->name('attendance.report');
     Route::post('attendance_report',[AttendenceReportController::class, 'attendance_search'])->name('attendance.search');
     Route::resource('quiz', QuizzController::class);
     Route::get('classess/{id}', [QuizzController::class ,'get_classes' ])->name('classess');
     Route::resource('question', QuestionController::class);
     Route::resource('online_zoom_classes', OnlineZoomClassController::class );
     Route::get('/indirect', [OnlineZoomClassController::class, 'create_indirect'])->name('indirect.teacher.create');
     Route::post('/indirect', [OnlineZoomClassController::class, 'store_indirect'])->name('indirect.teacher.store');
     Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');   
     Route::post('profile/{id}',[ ProfileController::class, 'update'])->name('profile.update');
     Route::get('tested_students/{id}', [QuizzController::class ,'tested_students' ])->name('tested_students');
     Route::post('exam_repetition/{id}', [QuizzController::class ,'exam_repetition' ])->name('exam_repetition');



    });


   
});