<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ship;
use Illuminate\Support\Str;

class ShipController extends Controller
{
    public function show()
    {
        $ships = Ship::paginate(10);
        return view('admin.ships.list', compact('ships'));
    }

    public function create()
    {
        return view('admin.ships.create');
    }

    public function store(Request $request)
    {
        $nameImage = "";
        // dd($request->hasFile("image"));
        if ($request->hasFile("image")) {
            $request->file('image')->store('public');
            $nameImage = $request->file('image')->store('public');
        }

        Ship::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status,
            'image' => $nameImage,
        ]);
        return redirect(route('ship.list'));
    }

    public function edit(Ship $ship)
    {
        return view('admin.ships.edit', compact('ship'));
    }

    public function update(Request $request, Ship $ship)
    {

        $ship->update($request->all());
        return redirect(route('ship.list'));
    }

    public function destroyer(Ship $ship)
    {
        $ship->delete();
        return redirect(route('ship.list'))->with('delete', 'ok');
    }

    public function search(Request $request)
    {
        if ($request->search != null) {
            $ships = Ship::where("name", "LIKE", "%{$request->get('search')}%")->paginate(10);
            return view('admin.ships.list', compact('ships'));
        }
        return back();
    }
}
