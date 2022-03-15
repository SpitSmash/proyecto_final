<?php

use App\Http\Controllers\ItineratyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\BayController;
use App\Http\Controllers\PenaltyController;
use App\Models\Itineraty;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Ship;

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
        return view('index', ['requested' => 'notLogged']);
    } else if (Auth::user()->hasRole('client')) {

        // Revisa si tiene itinerarios pending, aceptados y landed, NO BUSCA DENEGADOS NI DESPEGADOS
        // Necesita buscar el itinerario a través de la ID de su nave

        // SELECT status FROM itineraties WHERE 
        // (itineraties.status LIKE 'pending' OR itineraties.status LIKE 'accepted' OR itineraties.status LIKE 'landed' 
        // AND itineraties.ship_id = (SELECT user_id FROM ships WHERE user_id = '1'));

        $ship_id = Ship::where('user_id', Auth::user()->id)->first();
        if ($ship_id != null) {
            $itineraryValue = Itineraty::where('ship_id', $ship_id->id)->where(function ($query) {
                $query->where('status', 'pending')
                    ->orWhere('status', 'accepted')
                    ->orWhere('status', 'landed');
            })->first();

            $status = ($itineraryValue != null) ? $itineraryValue->status : 'none';
        } else {
            $status = 'none';
        }

        return view('index', ['requested' => $status]);
    } else {
        return view('index', ['requested' => 'none']);
    }
});

Route::post('/', [ItineratyController::class, 'store'])->name('request');

Auth::routes();

//accebility routes for clients
Route::group(['middleware' => ['role:client']], function () {

    Route::get('/client/itineraties/list', [ItineratyController::class, 'showClient'])->name('client.itineraty');
    Route::get('/client/ships/list', [ShipController::class, 'showClient'])->name('client.ship');
    Route::get('/client/penalties/list', [PenaltyController::class, 'showClient'])->name('client.penalty');
    Route::get('index', [ItineratyController::class, 'landing'])->name('landing');
    Route::get('index/takeoff', [ItineratyController::class, 'takeoff'])->name('takeoff');
});

//accebility routes for admins
Route::group(['middleware' => ['role:admin']], function () {
    // itineraties
    Route::get('/admin/itineraties/list', [ItineratyController::class, 'show'])->name('itineraty.list');
    Route::post('/admin/itineraties/list', [ItineratyController::class, 'search'])->name('itineraty.search');
    Route::get('/admin/itineraties/create', [ItineratyController::class, 'create'])->name('itineraty.create');
    Route::post('/admin/itineraties/create', [ItineratyController::class, 'store'])->name('itineraty.store');
    Route::get('/admin/itineraties/edit/{itineraty}', [ItineratyController::class, 'edit'])->name('itineraty.edit');
    Route::post('/admin/itineraties/edit/{itineraty}', [ItineratyController::class, 'update'])->name('itineraty.update');
    Route::delete('/admin/itineraties/delete/{itineraty}', [ItineratyController::class, 'destroyer'])->name('itineraty.destroy');

    //     // users
    Route::get('/admin/users/list', [UserController::class, 'show'])->name('user.list');
    Route::post('/admin/users/list', [UserController::class, 'search'])->name('user.search');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/admin/users/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/admin/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/users/edit/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/admin/users/delete/{user}', [UserController::class, 'destroyer'])->name('user.destroy');

    //     // ships
    Route::get('/admin/ships/list', [ShipController::class, 'show'])->name('ship.list');
    Route::post('/admin/ships/list', [ShipController::class, 'search'])->name('ship.search');
    Route::get('/admin/ships/create', [ShipController::class, 'create'])->name('ship.create');
    Route::post('/admin/ships/create', [ShipController::class, 'store'])->name('ship.store');
    Route::get('/admin/ships/edit/{ship}', [ShipController::class, 'edit'])->name('ship.edit');
    Route::post('/admin/ships/edit/{ship}', [ShipController::class, 'update'])->name('ship.update');
    Route::delete('/admin/ships/delete/{ship}', [ShipController::class, 'destroyer'])->name('ship.destroy');

    //     // bays
    Route::get('/admin/bays/list', [BayController::class, 'show'])->name('bay.list');
    Route::post('/admin/bays/list', [BayController::class, 'search'])->name('bay.search');
    Route::get('/admin/bays/create', [BayController::class, 'create'])->name('bay.create');
    Route::post('/admin/bays/create', [BayController::class, 'store'])->name('bay.store');
    Route::get('/admin/bays/edit/{bay}', [BayController::class, 'edit'])->name('bay.edit');
    Route::post('/admin/bays/edit/{bay}', [BayController::class, 'update'])->name('bay.update');
    Route::delete('/admin/bays/delete/{bay}', [BayController::class, 'destroyer'])->name('bay.destroy');

    //     // penalties
    Route::get('/admin/penalties/list', [PenaltyController::class, 'show'])->name('penalty.list');
    Route::post('/admin/penalties/list', [PenaltyController::class, 'search'])->name('penalty.search');
    Route::get('/admin/penalties/create', [PenaltyController::class, 'create'])->name('penalty.create');
    Route::post('/admin/penalties/create', [PenaltyController::class, 'store'])->name('penalty.store');
    Route::get('/admin/penalties/edit/{penalty}', [PenaltyController::class, 'edit'])->name('penalty.edit');
    Route::post('/admin/penalties/edit/{penalty}', [PenaltyController::class, 'update'])->name('penalty.update');
    Route::delete('/admin/penalties/delete/{penalty}', [PenaltyController::class, 'destroyer'])->name('penalty.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
