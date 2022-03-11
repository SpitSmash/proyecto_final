<?php

use App\Http\Controllers\ItineratyController;
use App\Models\Itineraty;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::user() == null) {
        return view('index', ['requested' => 'none']);
        
    } else if (Auth::user()->hasRole('client')) {
        // Revisa si tiene itinerarios pending, aceptados y landed, NO BUSCA DENEGADOS NI DESPEGADOS
        // Necesita buscar el itinerario a través de la ID de su nave

        /* Ligera idea, pero confuso af, sabado se hace
        Itineraty::where('ship_id', function ($join) {
            $join->on('ships.id', '=', Auth::user()->id);
        });
        */

        // Devolvería el respectivo estado, si es null, devuelve none
        return view('index', ['requested' => 'none']);
    } else {
        return view('index', ['requested' => 'none']);
    }
    
});

Route::post('/', [ItineratyController::class, 'store'])->name('request');

Auth::routes();

// Route::group(['middleware' => ['role:client']], function () {
//     Route::post('/content-layout/form', [RentController::class, 'store'])->name('form-rent');
//     Route::get('/content-layout/acknowledge', [RentController::class, 'index'])->name('acknowledge');
//     Route::get('/content-layout/my-list-rents', [RentController::class, 'myRents'])->name('my-rents');
// });
// Route::get()
//accebility routes for admins
Route::group(['middleware' => ['role:admin']], function () {
    // itineraties
    Route::get('/admin/itineraties/list', [ItineratyController::class, 'show'])->name('itineraty.list');
    Route::post('/admin/itineraties/list', [ItineratyController::class, 'search'])->name('itineraty.search');
//     Route::get('/admin/vehicles/create', [VehicleController::class, 'create'])->name('vehicle.create');
//     Route::post('/admin/vehicles/create', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::get('/admin/itineraties/edit/{itineraty}', [ItineratyController::class, 'edit'])->name('itineraty.edit');
    Route::post('/admin/itineraties/edit/{itineraty}', [ItineratyController::class, 'update'])->name('itineraty.update');
    Route::delete('/admin/itineraties/delete/{itineraty}', [ItineratyController::class, 'destroyer'])->name('itineraty.destroy');

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
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
