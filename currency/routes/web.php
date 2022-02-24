<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\EmployeeReport;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\emp;

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

Route::group(['middleware' => ['auth']], function(){
    Route::resource('dashboard', DashboardController::class);               
    Route::resource('exchange', CurrencyController::class);
    Route::resource('statistics', StatisticsController::class);
    Route::resource('transactions', TransactionController::class);  

});

Route::group(['middleware' => ['auth', 'role:admin|bank']], function(){
    Route::resource('employees', EmployeeController::class);       
    //Reports
    // Route::resource('reports', ReportController::class);   
    Route::get('employee_report',[EmployeeReport::class, 'index']);
    Route::post('Search_employees',[EmployeeReport::class, 'Search_employees']);
    
Route::get('/emp', [emp::class, 'showEmployees']);
Route::get('/employee/pdf', [emp::class, 'createPDF']);
    


});
Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::resource('banks', BankController::class);       
});
require __DIR__.'/auth.php';

Route::post('webhook', function(Request $request){
    if($request->type === 'charge.succeeded'){
        try{
            Payment::create([
                'stripe_id' => $request->data['object']['id'],
                'ammount' => $request->data['object']['ammount'],
                'email' => $request->data['object']['billing_details']['email'],
                'name' => $request->data['object']['billing_details']['name'],
            ]);
        }
        catch (\Exception $e){
            return $e->getMessage();
        }
    }
});