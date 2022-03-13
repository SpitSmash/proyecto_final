<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(){
        $users = User::paginate(12);
        return view('admin.users.list', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ])->assignRole('client');
        // $request['password']=bcrypt($request['password']);
        // User::create($request);
        return redirect(route('user.list'));
    }

    public function edit(User $user){
        // dd($vehicle);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user){
        $user->update($request->all());
        return redirect(route('user.list'));
    }

    public function destroyer(User $user)
    {
        $user->delete();
        return redirect(route('user.list'))->with('delete', 'ok');
    }

    public function search(Request $request)
    {
        // dd($request->search);
        if($request->search!=null) {
            $users = User::where("name", "LIKE", "%{$request->get('search')}%")->paginate(10);
            return view('admin.users.list', compact('users'));
        }
        return back(); 
    }
}
