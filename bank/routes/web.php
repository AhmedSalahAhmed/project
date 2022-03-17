<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'],  function(){
        Route::view('/login','admin.login')->name('admin.login');
        Route::post('/login', ['AdminController'::class, 'authenticate'])->name('admin.auth');

    });
    Route::group(['middleware' => 'admin.auth'],  function(){
        Route::get('/dashboard', ['dashboardController'::class, 'dashboard'])->name('admin.dashboard');

    });
   
});


