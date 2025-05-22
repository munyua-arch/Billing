<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\members;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {

        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view("users.create", compact('roles'));
    }


    public function store(Request $request)
    {

       
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|numeric|digits:10',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $validated['password'] = bcrypt($validated['password']); 

        $user =  User::create($validated);
        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Member deleted');

    }
}
