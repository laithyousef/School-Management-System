<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Quizzes\QuizController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Libraries\LibraryController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\ClassRooms\ClassRoomController;
use App\Http\Controllers\Students\OnlineClassController;
use App\Http\Controllers\Students\FeesInvoicesController;
use App\Http\Controllers\Students\FeeProcessingController;
use App\Http\Controllers\Students\StudentPaymentController;
use App\Http\Controllers\Students\StudentsReceiptController;


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



// Auth::routes();

Route::get('/', [HomeController::class, 'index' ])->name('selection');



Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::get('login/{type}', [LoginController::class, 'login_form' ])->name('login.show');
    Route::post('login/', [LoginController::class, 'login' ])->name('login');
    Route::get('/logout/{type}', [LoginController::class, 'logout' ])->name('logout');
});



Route::group(

    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function(){

        
    Route::get('dashboard', [HomeController::class, 'dashboard' ])->name('dashboard');


    Route::group(['namespace' => 'App\Http\Controllers\Grades'], function () {
        Route::resource('grades', GradeController::class);
       });


    Route::group(['namespace' => 'App\Http\Controllers\ClassRooms'], function () {
    Route::resource('class_rooms', ClassRoomController::class);
    Route::post('delete_all', [ClassRoomController::class ,'delete_all' ])->name('delete_all');
    Route::post('filter_classes', [ClassRoomController::class ,'filter_classes' ])->name('filter_classes');
    });

    Route::group(['namespace' => 'App\Http\Controllers\Sections'], function () {
        Route::resource('sections', SectionController::class);
        Route::get('classes/{id}', [SectionController::class ,'get_classes' ])->name('classes');

    });

   Route::view('add_parent', 'livewire.show_form');

   Route::group(['namespace' => 'App\Http\Controllers\Teachers'], function () {
    Route::resource('teachers', TeacherController::class);
    });

    Route::group(['namespace' => 'App\Http\Controllers\Students'], function () {
        Route::resource('students', StudentController::class);
        Route::get('classes/{id}', [StudentController::class ,'get_classes' ])->name('classes');
        Route::post('upload_attachment', [StudentController::class ,'upload_attachment' ])->name('upload_attachment');
        Route::post('download_attachment/{student_name}/{filename}', [StudentController::class ,'download_attachment' ])->name('download_attachment');
        Route::post('delete_attachment', [StudentController::class ,'delete_attachment' ])->name('delete_attachment');

        Route::resource('promotions', PromotionController::class);
        Route::get('promotion_management', [PromotionController::class ,'promotion_roll_back' ])->name('promotion_management');

        Route::resource('graduated', GraduatedController::class);
        Route::resource('fees', FeesController::class);
        Route::resource('fees_invoices', FeesInvoicesController::class);
        Route::resource('students_receipt',StudentsReceiptController::class);
        Route::resource('Fee_Processing', FeeProcessingController::class);
        Route::resource('students_payment',StudentPaymentController::class);
        Route::resource('attendance',AttendanceController::class);
        // Route::post('attendance', [AttendanceController::class ,'store' ])->name('attendance.store');
        // Route::get('show/{id}', [AttendanceController::class ,'show' ])->name('attendance.show');

        Route::resource('online_classes',OnlineClassController::class);
        Route::get('create_indirect', [OnlineClassController::class ,'create_indirect' ])->name('create_indirect');
        Route::post('store_indirect', [OnlineClassController::class ,'store_indirect' ])->name('store_indirect');
    });
    
    Route::group(['namespace' => 'App\Http\Controllers\Subjects'], function () {
        Route::resource('subjects', SubjectController::class);

    });


    Route::group(['namespace' => 'App\Http\Controllers\Quizzes'], function () {
        Route::resource('quizzes', QuizController::class);
    });


    Route::group(['namespace' => 'App\Http\Controllers\Questions'], function () {
        Route::resource('questions', QuestionController::class);
    });


    Route::group(['namespace' => 'App\Http\Controllers\Libraries'], function () {
        Route::resource('libraries', LibraryController::class);
        Route::get('download_attachment/{filename}', [LibraryController::class ,'download_attachment' ])->name('download_attachment');
    });



    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');



});




