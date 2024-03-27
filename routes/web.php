<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StatisticalController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');

        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');

        Route::get('restore/{id}', 'restore')->name('restore');
        Route::get('block/{id}', 'block')->name('block');

        Route::get('destroy/{id}', 'destroy')->name('destroy');
    });

    Route::get('',[StatisticalController::class,'index'])->name('/');
   
});

Route::get('auth/login',[LoginController::class,'index'])->name('login');
