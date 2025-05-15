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

        return redirect()->route('client.index')->with('success', 'New client created successfully!');
    }
    
    public function edit($id)
    {
        $client = Clients::findOrFail($id);
        $packages = Packages::all(); 
        
        return view('clients.edit', compact('client', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'connection_type' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:clients,username,'.$id,
            'expiry_date' => 'required|date',
            'package' => 'required|string|max:100',
            'phone_number' => 'required|string|max:10',
            'location' => 'required|string|max:100',
            'password' => 'nullable|string|min:6' // Make password optional for updates
        ]);

        $client = Clients::findOrFail($id);
        
        // Only update password if it was provided
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = $validated['password'];
        }

        $client->update($validated);

        return redirect()->route('client.index')->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        $client = Clients::findOrFail($id);
        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client removed sucessfully!');
       
    }
    
}


