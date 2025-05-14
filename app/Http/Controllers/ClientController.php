<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Packages;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index()
    {
        $clients = Clients::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $packages = Packages::all(); 

        return view('clients.create', compact('packages'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
                'connection_type' => 'required|string|max:100',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'username' => 'required|string|max:100|unique:clients',
                'password' => 'required|string|max:100',
                'expiry_date' => 'required|date',
                'package' => 'required|string|max:100',
                'phone_number' => 'required|string|max:100',
                'location' => 'required|string|max:100'
        ]); 

        Clients::create($validated);

        return redirect()->route('clients.index')->with('success', 'New client created successfully!');
    }
    
    public function edit()
    {

       
    }

    public function update()
    {

       
    }

    public function delete()
    {

       
    }
    
}


