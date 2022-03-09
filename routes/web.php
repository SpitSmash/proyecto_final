<?php

use App\Http\Controllers\RequestController;
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
    return view('index');
});

Route::post('/', [RequestController::class, 'store'])->name('request');

Auth::routes();

// Route::group(['middleware' => ['role:client']], function () {
//     Route::post('/content-layout/form', [RentController::class, 'store'])->name('form-rent');
//     Route::get('/content-layout/acknowledge', [RentController::class, 'index'])->name('acknowledge');
//     Route::get('/content-layout/my-list-rents', [RentController::class, 'myRents'])->name('my-rents');
// });
// Route::get()
//accebility routes for admins
// Route::group(['middleware' => ['role:admin']], function () {
//     // vehicles
//     Route::get('/admin/vehicles/list', [VehicleController::class, 'adminVeh'])->name('vehicle.list');
//     Route::post('/admin/vehicles/list', [VehicleController::class, 'search'])->name('vehicle.search');
//     Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])->name('vehicle.create');
//     Route::post('/admin/vehicles/create', [VehicleController::class, 'store'])->name('vehicle.store');
//     Route::get('/admin/vehicles/edit/{vehicle}', [VehicleController::class, 'edit'])->name('vehicle.edit');
//     Route::post('/admin/vehicles/edit/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
//     Route::delete('/admin/vehicles/delete/{vehicle}', [VehicleController::class, 'destroyer'])->name('vehicle.destroy');

//     // users
//     Route::get('/admin/users/list', [UserController::class, 'adminUser'])->name('user.list');
//     Route::post('/admin/users/list', [UserController::class, 'search'])->name('user.search');
//     Route::get('/admin/users/create', [UserController::class, 'create'])->name('user.create');
//     Route::post('/admin/users/create', [UserController::class, 'store'])->name('user.store');
//     Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
//     Route::post('/admin/users/edit/{user}', [UserController::class, 'update'])->name('user.update');
//     Route::delete('/admin/users/delete/{user}', [UserController::class, 'destroyer'])->name('user.destroy');
//     // rentings
//     Route::get('/admin/rentings/list', [RentController::class, 'adminRent'])->name('rent.list');
//     Route::post('/admin/rentings/list', [RentController::class, 'search'])->name('rent.search');
//     Route::get('/admin/rentings/edit/{rent}', [RentController::class, 'edit'])->name('rent.edit');
//     Route::post('/admin/rentings/edit/{rent}', [RentController::class, 'update'])->name('rent.update');
//     Route::delete('/admin/rentings/delete/{rent}', [RentController::class, 'destroyer'])->name('rent.destroy');

//     // penalties
//     Route::get('/admin/penalties/list', [PenaltyController::class, 'show'])->name('penalty.list');
//     Route::post('/admin/penalties/list', [PenaltyController::class, 'search'])->name('penalty.search');
//     Route::get('/admin/penalties/edit/{penalty}', [PenaltyController::class, 'edit'])->name('penalty.edit');
//     Route::post('/admin/penalties/edit/{penalty}', [PenaltyController::class, 'update'])->name('penalty.update');
//     Route::delete('/admin/penalties/delete/{penalty}', [PenaltyController::class, 'destroyer'])->name('penalty.destroy');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
