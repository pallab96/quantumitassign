<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

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


Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'login'])->name('login');


Route::group(['middleware' =>  ['admin']],function(){
    //dashboard
    Route::get('/',[DashboardController::class,'index'])->name('home');

    // Companies
    Route::resource('companies',CompanyController::class);

    //Employees
    Route::resource('employees',EmployeeController::class);

    //logout
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
});
