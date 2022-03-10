<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itineraty;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Ship;
use App\Models\Bay;

class ItineratyController extends Controller
{
    function show(){
        $itineraties = Itineraty::all();
        return view('/admin/itineraties/list', compact('itineraties'));
    }

    function store(Request $request)
    {
        if (Auth::user() != null && Auth::user()->hasRole('client')) {
            // dd(Ship::where("user_id", Auth::user()->id)->first());
            if (Ship::where("user_id", Auth::user()->id)->first() == null) {
                return redirect(url('/'))->with('error', 'notship');
            } else { 
                $ship_id = Ship::where("user_id", Auth::user()->id)->first()->id;
                if ($request->to != null) {
                    $today = date('m/d/Y H:i');
                    $date1 = Carbon::createFromFormat('m/d/Y H:i', $today);
                    $date2 = Carbon::createFromFormat('m/d/Y H:i', $request->to . ' ' . $request->dropoffTime);
                    // dd($date1, $date2);
                    if ($date1 > $date2) {
                        return redirect(url('/'))->with('error', 'lessdate');
                    }

                    if(Bay::where("available", 1)->first() == null){
                        return redirect(url('/'))->with('error', 'bayfull');

                    }

                    $bay = Bay::where("available", 1)->first();

                    Itineraty::create([
                        'date_estimated_takeoff' => $date2,
                        'ship_id' => $ship_id,
                        'bay_id' => $bay->id,
                        'status' => 'pending',
                    ]);

                    $bay->update([
                        'available' => 0,
                    ]);

                    return redirect(url('/'))->with('success', 'request');
                } else {
                    return redirect(url('/'))->with('error', 'datempy');
                }
            }


            // dd($request->to);
        }
        return redirect(url('/'))->with('error', 'difrole');
    }
}
