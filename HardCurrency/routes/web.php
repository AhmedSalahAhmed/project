<?php

use App\Http\Controllers\manager\ManagerDashboardController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [App\Http\Controllers\FirstRouteController::class, 'index']);

Route::get('manager/', function () {
    return view('manager.login');
});

Route::get('bank/', function () {
    return view('bank.login');
});

Auth::routes();
//central Bank Routes
Route::group(['prefix' => 'centralbank'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('statistics', centralbank\StatisticsController::class);
        Route::resource('banks', centralbank\BankController::class);
        Route::resource('currency', centralbank\CurrencyController::class);
        Route::resource('price', centralbank\PriceController::class);
        Route::resource('bankaccounts', centralbank\BanksAccountsController::class);
        Route::resource('managers', centralbank\ManagersController::class);
        Route::resource('users', centralbank\UsersController::class);
        Route::get('/accountsreport', [App\Http\Controllers\centralbank\CentralReportController::class, 'accountsreport']);
        Route::get('/processesreport', [App\Http\Controllers\centralbank\CentralReportController::class, 'processesreport']);
        Route::get('/currencygrowth', [App\Http\Controllers\centralbank\StatisticsController::class, 'currencies_growth']);
        Route::get('/top_banks', [App\Http\Controllers\centralbank\StatisticsController::class, 'top_banks']);

    });
});

//Bank Managers Routes
Route::group(['prefix' => 'manager'], function () {
    Route::group(['middleware' => 'manager.guest'], function () {
        Route::view('/login', 'manager.login')->name('manager.login');
        Route::post('/login', [App\Http\Controllers\manager\ManagerController::class, 'authenticate'])->name('manager.auth');
    });

    Route::group(['middleware' => 'manager.auth'], function () {
        Route::get('/dashboard', [App\Http\Controllers\manager\ManagerDashboardController::class, 'index'])->name('manager.dashboard');
        Route::resource('employees', manager\EmployeesController::class);
        Route::resource('account', manager\BankAccountController::class);
        Route::resource('branch', manager\BranchController::class);
        Route::resource('process', manager\ProcessController::class);
        Route::get('/logout', [App\Http\Controllers\manager\ManagerController::class, 'logout'])->name('manager.logout');
        Route::resource('manager', manager\ManagerDashboardController::class);
        Route::get('/stats', [App\Http\Controllers\manager\StatisticsController::class, 'index'])->name('manager.stats');
        // Rrports
        Route::get('/bankreports', [App\Http\Controllers\manager\CurrencyReportController::class, 'index']);
        Route::get('/searchcurrency', [App\Http\Controllers\manager\CurrencyReportController::class, 'searchcurrency']);
        Route::get('/processreport', [App\Http\Controllers\manager\CurrencyReportController::class, 'searchprocess']);
        Route::get('/bankaccountreport', [App\Http\Controllers\manager\CurrencyReportController::class, 'bankaccountreport']);

    });
});
//Bank Employees Routes
Route::group(['prefix' => 'bank'], function () {
    Route::group(['middleware' => 'employee.guest'], function () {
        Route::view('/login', 'bank.login')->name('employee.login');
        Route::post('/login', [App\Http\Controllers\bank\EmployeeController::class, 'authenticate'])->name('employee.auth');
    });

    Route::group(['middleware' => 'employee.auth'], function () {
        // Route::resource('processes', bank\EmployeeProcessController::class);

        Route::get('/dashboard', [App\Http\Controllers\bank\EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
        Route::get('/getTotal', [App\Http\Controllers\bank\EmployeeDashboardController::class, 'getTotal'])->name('getTotal');
        Route::get('/logout', [App\Http\Controllers\bank\EmployeeController::class, 'logout'])->name('employee.logout');
        Route::resource('bank', bank\EmployeeDashboardController::class);
        Route::resource('transaction', bank\EmployeeProcessController::class);
    });
});
