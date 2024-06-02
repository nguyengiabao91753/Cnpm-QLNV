<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmpSalaryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\Client\LoginController as ClientLoginController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ScheduleController as ClientScheduleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TestMailController;
use App\Models\Admin\Department;
use App\Models\Admin\Work_Schedule;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[LoginController::class,'index']);

Route::prefix('admin')->name('admin.')->middleware('check_login')->group(function () {
    Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('show/{id}', 'show')->name('show');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('restore/{id}', 'restore')->name('restore');
        Route::get('block/{id}', 'block')->name('block');

        Route::get('destroy/{id}', 'destroy')->name('destroy');

       
    });
    Route::prefix('account')->name('account.')->controller(AccountController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        // Route::get('create', 'create')->name('create');
        // Route::post('store', 'store')->name('store');

        Route::get('show/{id}', 'show')->name('show');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('restore/{id}', 'restore')->name('restore');
        

        Route::get('destroy/{id}', 'destroy')->name('destroy');

    });
    Route::prefix('schedule')->name('schedule.')->controller(ScheduleController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('show/{id}', 'show')->name('show');
       

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        // Route::get('restore/{id}', 'restore')->name('restore');
        

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });
    Route::prefix('attendance')->name('attendance.')->controller(AttendanceController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('request', 'request')->name('request');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');


        Route::get('clock_in/{id}', 'clock_in')->name('clock_in');
        Route::get('clock_out/{id}', 'clock_out')->name('clock_out');
        Route::post('dayoff/{id}', 'dayoff')->name('dayoff');


        Route::get('show/{id}', 'show')->name('show');

        Route::get('allow/{id}', 'allow')->name('allow');
        Route::post('update/{id}', 'update')->name('update');

        // Route::get('getatt/{id}', 'restore')->name('restore');
        

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::get('',[StatisticalController::class,'index'])->name('/');
    Route::get('calc',[EmpSalaryController::class,'calc'])->name('calc');
    
});
//Client
Route::prefix('')->middleware('check_client')->group(function(){
    Route::get('/profile',[ProfileController::class,'getemp'])->name('profile');
    Route::get('/schedule',[ClientScheduleController::class,'index'])->name('schedule');
});
 
//  Route::get('/clock_in/{id}',[ClientScheduleController::class,'clock_in'])->name('clock_in');
//  Route::get('/clock_out/{id}',[ClientScheduleController::class,'clock_out'])->name('clock_out');
//  Route::get('/day-off/{id}',[ClientScheduleController::class,'day-off'])->name('day-off');

//AJAX
Route::get('/getpos/{id}',[PositionController::class,'getpos']);
Route::get('/getempbypos/{id}',[EmployeeController::class,'getempbypos']);
Route::get('/getroom/{id}',[RoomController::class,'getroom']);
Route::get('/getatt/{data}',[AttendanceController::class,'getatt']);
Route::get('/showsal',[EmpSalaryController::class,'showsal']);

Route::get('/getattbydep',[StatisticalController::class,'getattbydep']);


//Admin login
Route::get('auth/login',[LoginController::class,'index'])->name('login');
Route::post('amlogin',[LoginController::class,'login'])->name('amlogin');

//Client Login
Route::get('auth/clientlogin',[ClientLoginController::class,'index'])->name('employeelogin');
Route::post('cllogin',[ClientLoginController::class,'login'])->name('cllogin');


//Logout
Route::get('/logout/{guard}',[LogoutController::class,'logout'])->name('logout');

//MAIL
Route::get('/sendmail',[TestMailController::class,'index']);
Route::post('/sendmail',[TestMailController::class,'sendmail'])->name('sendmail');