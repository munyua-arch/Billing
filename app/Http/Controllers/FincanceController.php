<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;

class FincanceController extends Controller
{
    //
    public function index()
    {
        $packages = Packages::paginate(10);

        return view('finance.index', compact('packages'));
    }

    public function create()
    {
        return view('finance.create');
    }


    public function store(Request $request)
    {



        $validated = $request->validate([
            'package_type' => 'required|string|max:255',
            'package_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'upload_speed' => 'required|string|max:255',
            'download_speed' => 'required|string|max:255'
        ]);


        try {
            $package =  Packages::create($validated);
        } catch(\Exception $e)
        {
            dd($e->getMessage());
        }

        return redirect()->route('finance.packages')->with('success', 'Package created successfully');
    }

    public function expenses()
    {
        
    }

    public function edit($id)
    {
        $package = Packages::findOrFail($id); // Better to use findOrFail() to handle missing IDs
        
        return view('finance.edit', compact('package')); // Pass variable name as string
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_type' => 'required|string|max:255',
            'package_name' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'upload_speed' => 'required|string|max:255',
            'download_speed' => 'required|string|max:255'
        ]);

        $package = Packages::findOrFail($id);
        $package->update($validated);

        return redirect()->route('finance.packages')->with('success', 'Package updated,successfully');
    }

    public function delete($id)
    {
        $package = Packages::findOrFail($id);
        $package->delete();

        return redirect()->route('finance.packages')->with('success', 'Package removed,successfully');
        
    }

}
