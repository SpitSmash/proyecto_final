<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Itineraty;
use App\Models\Penalty;
use App\Models\Ship;
use App\Models\Bay;



class ItineratyController extends Controller
{
    function show()
    {
        $itineraties = Itineraty::all();
        return view('/admin/itineraties/list', compact('itineraties'));
    }

    public function create()
    {
        return view('admin.itineraties.create');
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

                    if (Bay::where("available", 1)->first() == null) {
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
                    return redirect(url('/'))->with('error', 'dateempty');
                }
            }
            // dd($request->to);
        } else {
            if (Auth::user()->hasRole('admin')) {
                $today = date('m/d/Y H:i');
                $date3 = Carbon::createFromFormat('m/d/Y H:i', $today);
                $date4 = Carbon::createFromFormat('m/d/Y H:i', $request->to . ' ' . $request->dropoffTime);

                if ($date3 > $date4) {
                    return redirect(url('/'))->with('error', 'lessdate');
                }

                Itineraty::create([
                    'date_estimated_takeoff' => $date4,
                    'ship_id' => $request->ship_id,
                    'bay_id' => $request->bay_id,
                    'status' => $request->status,
                ]);
                return redirect(url('/'))->with('success', 'request');
            }
        }
        return redirect(url('/'))->with('error', 'difrole');
    }

    public function edit(Itineraty $itineraty)
    {
        // dd($vehicle);
        return view('admin.itineraties.edit', compact('itineraty'));
    }

    public function update(Request $request, Itineraty $itineraty)
    {
        // dd($itineraty);
        $itineraty->update($request->all());
        if ($request->status == 'accepted') {
            // dd($request->status);
            $bay = Bay::where("available", 1)->first();
            $bay->update([
                'available' => 0,
            ]);
            $today = Carbon::createFromFormat('m/d/Y H:i', date('m/d/Y H:i'));
            $date_estimated_landing = $today->addMinutes(10);
            $itineraty->update([
                'date_estimated_landing' => $date_estimated_landing,
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

    private function getToday()
    {
        return Carbon::createFromFormat('m/d/Y H:i', date('m/d/Y H:i'));
    }

    public function landing()
    {
        if (Auth::user() != null && Auth::user()->hasRole('client')) {
            $ship_id = Ship::where("user_id", Auth::user()->id)->first()->id;

            if ($ship_id != null) {
                // $itineraty = Itineraty::where("ship_id", $ship_id)->first();
                $itineraty = Itineraty::where('ship_id', $ship_id)->where(function ($query) {
                    $query->where('status', 'pending')
                        ->orWhere('status', 'accepted')
                        ->orWhere('status', 'landed');
                })->first();

                $date = $this->getToday();


                if ($this->checkLanding($date, $itineraty)) {
                    return redirect(url('/'))->with('success', 'landing');
                } else {
                    $this->createPenalty($date, $itineraty);
                    return redirect(url('/'))->with('success', 'landingPenalty');
                }
            } else {
                return redirect(url('/'))->with('error', 'notship');
            }
        }
    }

    private function checkLanding(Carbon $date, Itineraty $itineraty)
    {
        $costEstimated = 100 * ($date->floatDiffInDays($itineraty->date_estimated_takeoff));
        $itineraty->update([
            'date_landing' => $date,
            'status' => 'landed',
            'price' => $costEstimated,
        ]);
        return ($date <= $itineraty->date_estimated_landing);
    }

    private function createPenaltyTime(Carbon $date, Itineraty $itineraty, $status = "landing")
    {
        $subsMinutes = $itineraty->date_estimated_landing->floatDiffInMinutes($date);
        if ($status == "takeoff") {
            $subsMinutes = $itineraty->date_estimated_takeoff->floatDiffInMinutes($date);
        }
        $cost = ($subsMinutes * (($itineraty->price * 0.000002) + $itineraty->price)) / 100;
        return [
            'total' => $cost + $itineraty->price,
            'cost' => $cost,
            'minutes' => $subsMinutes,
        ];
    }

    private function createPenalty(Carbon $date, Itineraty $itineraty)
    {
        $time = $this->createPenaltyTime($date, $itineraty);

        $itineraty->update([
            'price' => $time['total'],
        ]);

        return Penalty::create([
            'price' => $time['cost'],
            'comments' => 'Minutes Later: ' . round($time['minutes'], 2),
            'user_id' => Auth::user()->id,
            'itineraty_id' => $itineraty->id,
        ]);
    }



    public function takeoff()
    {
        if (Auth::user() != null && Auth::user()->hasRole('client')) {
            $ship_id = Ship::where("user_id", Auth::user()->id)->first()->id;
            if ($ship_id != null) {
                // $itineraty = Itineraty::where("ship_id", $ship_id)->first();

                $itineraty = Itineraty::where('ship_id', $ship_id)->where(function ($query) {
                    $query->where('status', 'pending')
                        ->orWhere('status', 'accepted')
                        ->orWhere('status', 'landed');
                })->first();

                $date = $this->getToday();
                $itineraty->update([
                    'date_takeoff' => $date,
                    'status' => 'done',
                ]);


                if ($date <= $itineraty->date_estimated_takeoff) {
                    return redirect(url('/'))->with('success', 'takeoff');
                } else {
                    $penalty = Penalty::where('itineraty_id', $itineraty->id)->first();
                    if ($penalty == null) {
                        $this->createPenalty($date, $itineraty);
                    } else {
                        $time = $this->createPenaltyTime($date, $itineraty, "takeoff");

                        $itineraty->update([
                            'price' => $time['total'],
                        ]);

                        $comments = $penalty->comments;
                        $penalty->update([
                            'price' => $time['cost'],
                            'comments' => $comments . ' Minutes Later: ' . round($time['minutes'], 2),
                        ]);
                    }

                    return redirect(url('/'))->with('success', 'takeoffPenalty');
                }
            } else {
                return redirect(url('/'))->with('error', 'notship');
            }
        }
    }

    public function showClient()
    {
        $ship_id = Ship::where("user_id", Auth::user()->id)->first()->id;
        $itineraties = Itineraty::where("ship_id", $ship_id)->paginate(10);
        return view('client.itineraties.list', compact('itineraties'));
    }
}
