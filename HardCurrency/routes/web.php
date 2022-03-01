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

Route::get('/centralbank', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('centralbank/bank', centralbank\BankController::class);       
    Route::resource('centralbank/employee', centralbank\EmployeesController::class);       

});
// Route::prefix('employee')->group(function() {

//     Route::group(['middleware' => 'employee.guest'],  function(){
//         Route::view('/login','employee.login')->name('employee.login');
//         // Route::post('/login', ['EmployeeController'::class, 'authenticate'])->name('employee.auth');
//     Route::post('/login', 'Auth\EmployeeController@login')->name('employee.auth');


//     });
//     Route::group(['middleware' => 'employee.auth'],  function(){
//         Route::get('/dashboard', ['dashboardController'::class, 'dashboard'])->name('employee.dashboard');

//     });
    
Route::group(['prefix' => 'employee'], function() {
    Route::group(['middleware' => 'employee.guest'], function(){
        Route::view('/login','employee.login')->name('employee.login');
        Route::post('/login',[App\Http\Controllers\EmployeeController::class, 'authenticate'])->name('employee.auth');
    });

    Route::group(['middleware' => 'employee.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\EmployeeDashboardController::class, 'dashboard'])->name('employee.dashboard');
        Route::get('/logout', [App\Http\Controllers\EmployeeController::class, 'logout'])->name('employee.logout');

    });
});
