<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Parents\dashboard\childrenController;

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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================

    Route::get('/parent/dashboard', function () {

        $sons = Student::where('parent_id', Auth::user()->id)->get();

        return view('pages.parents.dashboard', compact('sons'));
    })->name('parents.dashboard');

    Route::group(['namespace' => 'App\Http\Controllers\Parents\dashboard'], function () {
       Route::get('index', [childrenController::class, 'index' ])->name('parent.index');
       Route::get('sons_results/{id}', [childrenController::class, 'sons_results' ])->name('sons.results');
       Route::get('sons_attendance', [childrenController::class, 'sons_attendance' ])->name('son.attendance');
       Route::post('sons_attendance', [childrenController::class, 'attendance_search' ])->name('attendance_search');
       Route::get('sons_fees', [childrenController::class, 'sons_fees' ])->name('son.fees');
       Route::get('sons_receipt', [childrenController::class, 'sons_receipt' ])->name('son.receipt');
       Route::get('parent_profile',[childrenController::class, 'parent_profile'])->name('profile.parent.show');
       Route::put('parent_profile/{id}',[childrenController::class, 'update_parent_profile'])->name('profile.parent.update');       


    });
   

});