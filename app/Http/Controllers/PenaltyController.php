<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penalty;

class PenaltyController extends Controller
{
    public function show()
    {
        $penalties = Penalty::paginate(10);
        return view('admin.penalties.list', compact('penalties'));
    }

    public function search(Request $request)
    {
        if ($request->search != null) {
            $penalties = Penalty::where("id", "LIKE", "%{$request->get('search')}%")->paginate(10);
            return view('admin.penalties.list', compact('penalties'));
        }
        return back();
    }

    public function create()
    {
        return view('admin.penalties.create');
    }

    public function store(Request $request)
    {

        Penalty::create([
            'price' => $request->price,
            'comments' => $request->comments,
            'user_id' => $request->user_id,
            'itineraty_id' => $request->itineraty_id,
        ]);
        return redirect(route('penalty.list'));
    }

    public function edit(Penalty $penalty)
    {
        return view('admin.penalties.edit', compact('penalty'));
    }

    public function update(Request $request, Penalty $penalty)
    {
            $penalty->update($request->all());
            return redirect(route('penalty.list'));
    }

    public function destroyer(Penalty $penalty)
    {
        $penalty->delete();
        return redirect(route('penalty.list'))->with('delete', 'ok');
    }

    public function showClient()
    {
        $penalties = Penalty::where("user_id", Auth::user()->id)->paginate(10);
        return view('client.penalties.list', compact('penalties'));
    }
}
