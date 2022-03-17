<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    public function create2()
    {
        return view('client.registrer');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|max:2048',
        ]);
        $image = $request->file('image')->store('public/images');
        $url = Storage::url($image);

        Ship::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status,
            'image' => $url,
        ]);
        return redirect(route('ship.list'));
    }

    public function store2(Request $request)
    {

        $request->validate([
            'image' => 'required|image|max:2048',
        ]);
        $image = $request->file('image')->store('public/images');
        $url = Storage::url($image);

        Ship::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'description' => $request->description,
            'type' => $request->type,
            'status' => $request->status,
            'image' => $url,
        ]);
        return view('index',['requested' => 'none']);
    }

    public function edit(Ship $ship)
    {
        return view('admin.ships.edit', compact('ship'));
    }

    public function update(Request $request, Ship $ship)
    {
        $data = $request->all();

        if ($request->image != null) {
            $request->validate([
                'image' => 'image|max:2048',
            ]);
            $image = $request->file('image')->store('public/images');
            $data['image'] = Storage::url($image); 
        }
        // dd($data);
        $ship->update($data);

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

    public function showClient()
    {
        $ships = Ship::where("user_id", Auth::user()->id)->paginate(10);
        return view('client.ships.list', compact('ships'));
    }
}
