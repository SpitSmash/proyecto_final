<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bay;

class BayController extends Controller
{
    public function show(){
        $bays = Bay::paginate(12);
        return view('admin.bays.list', compact('bays'));
    }

    public function create(){
        return view('admin.bays.create');
    }

    public function store(Request $request){
        // dd($request);
        Bay::create([
            'available' => intval($request->available),
            'size' => intval($request->size),
        ]);
        return redirect(route('bay.list'));
    }

    public function edit(Bay $bay){
        // dd($vehicle);
        return view('admin.bays.edit', compact('bay'));
    }

    public function update(Request $request, Bay $bay){
        $bay->update($request->all());
        return redirect(route('bay.list'));
    }

    public function destroyer(Bay $bay)
    {
        $bay->delete();
        return redirect(route('bay.list'))->with('delete', 'ok');
    }

    public function search(Request $request)
    {
        // dd($request->search);
        if($request->search!=null) {
            $bays = Bay::where("id", "LIKE", "%{$request->get('search')}%")->paginate(10);
            return view('admin.bays.list', compact('bays'));
        }
        return back(); 
    }
}
