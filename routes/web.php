<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FincanceController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SmsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('roles', [RolesController::class, 'index'])->name('roles.index');

	Route::get('sms', [SmsController::class, 'index'])->name('sms.index');
	Route::get('sms/create', [SmsController::class, 'create'])->name('sms.create');
	Route::post('sms/create', [SmsController::class, 'store'])->name('sms.store');
	Route::get('sms/to-all', [SmsController::class, 'toAll'])->name('sms.to-all');
	Route::post('sms/to-all', [SmsController::class, 'sendAll'])->name('sms.sendAll');

	// client routes
	Route::get('clients', [ClientController::class, 'index'])->name('client.index');
	Route::get('clients/create', [ClientController::class, 'create'])->name('client.create');
	Route::post('clients/create', [ClientController::class, 'store'])->name('client.store');
	Route::get('clients/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
	Route::put('clients/edit/{id}', [ClientController::class, 'update'])->name('client.update');
	Route::delete('client/{id}', [ClientController::class, 'destroy'])->name('client.destroy');


	// fincance routes
	Route::get('packages', [FincanceController::class, 'index'])->name('finance.packages');
	Route::get('packages/create', [FincanceController::class, 'create'])->name('finance.create');
	Route::post('packages/create', [FincanceController::class, 'store'])->name('finance.store');
	Route::get('packages', [FincanceController::class, 'index'])->name('finance.packages');
	Route::get('packages/{id}/edit', [FincanceController::class, 'edit'])->name('finance.edit');
	Route::put('packages/{id}', [FincanceController::class, 'update'])->name('finance.update');
	Route::delete('packages/{id}', [FincanceController::class, 'delete'])->name('finance.delete');

	// client routes
	Route::get('payments', [PaymentsController::class, 'index'])->name('payment.index');

	// Expense Routes
	Route::get('expenses', [ExpenseController::class, 'index'])->name('expenses.index');
	Route::get('expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
	Route::post('expenses/create', [ExpenseController::class, 'store'])->name('expenses.store');
	Route::get('expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
	Route::put('expenses/{id}', [ExpenseController::class, 'update'])->name('expenses.update');
	Route::delete('expenses/{id}', [ExpenseController::class, 'delete'])->name('expenses.delete');

	// roles & permissions routes
	Route::get('roles & permissions', [RoleController::class, 'index'])->name('roles.index');
	Route::get('create', [RoleController::class, 'create'])->name('roles.create');
	Route::post('create', [RoleController::class, 'store'])->name('roles.store');
	Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
	Route::put('edit/{id}', [RoleController::class, 'update'])->name('roles.update');
	Route::delete('roles & permissions/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
	
});

