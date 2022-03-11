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

                    

                    return redirect(url('/'))->with('success', 'request');
                } else {
                    return redirect(url('/'))->with('error', 'datempy');
                }
            }


            // dd($request->to);
        }
        return redirect(url('/'))->with('error', 'difrole');
    }

    public function edit(Itineraty $itineraty)
    {
        // dd($vehicle);
        return view('admin.itineraties.edit', compact('itineraty'));
    }

    public function update(Request $request, Itineraty $itineraty){
        // dd($itineraty);
        $itineraty->update($request->all());
        if($request->status == 'accepted'){
            // dd($request->status);
            $bay = Bay::where("available", 1)->first();
            $bay->update([
                'available' => 0,
            ]);
            $today = Carbon::createFromFormat('m/d/Y H:i', date('m/d/Y H:i'));
            $date_estimated_landing = $today->addMinutes(10);
            $itineraty->update([
                'date_estimated_landing'=>$date_estimated_landing,
            ]);
        }
        $itineraties = Itineraty::all();
        return view('/admin/itineraties/list', compact('itineraties'));
    }

    public function search(Request $request)
    {
        // dd($request->search);
        if ($request->search != null) {
            $id = Ship::where("name", "LIKE", "%{$request->get('search')}%")->first('id');
            // dd($id->id);
            $itineraties = Itineraty::where("ship_id", "=", $id->id)->paginate(10);
            // dd($rents);
            return view('admin.itineraties.list', compact('itineraties'));
        }
        return back();
    }

    public function destroyer(Itineraty $itineraty)
    {
        $itineraty->delete();
        return redirect(route('itineraty.list'))->with('delete', 'ok');
    }
}
