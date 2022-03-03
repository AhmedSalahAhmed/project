<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'centralbank'], function() {

Route::group(['middleware' => 'auth'], function(){
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('statistics', centralbank\StatisticsController::class);

    Route::resource('banks', centralbank\BankController::class);       
    Route::resource('currency', centralbank\CurrencyController::class);       

    Route::resource('employee', centralbank\EmployeesController::class);       

    });
});

    
Route::group(['prefix' => 'bank'], function() {
    Route::group(['middleware' => 'employee.guest'], function(){
        Route::view('/login','bank.login')->name('employee.login');
        Route::post('/login',[App\Http\Controllers\bank\EmployeeController::class, 'authenticate'])->name('employee.auth');
    });

    Route::group(['middleware' => 'employee.auth' ], function(){
        Route::get('/dashboard',[App\Http\Controllers\bank\EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        Route::get('/logout', [App\Http\Controllers\bank\EmployeeController::class, 'logout'])->name('employee.logout');
        Route::resource('bank', bank\EmployeeDashboardController::class);       


    });
});
