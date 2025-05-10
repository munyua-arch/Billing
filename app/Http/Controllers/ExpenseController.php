<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    //
    public function index()
    {
        $expenses    = Expenses::all(); 

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:100',
            'method' => 'required|string|max:100',
            'amount' => 'required|string|max:100'
        ]); 

        Expenses::create($validated);

        return redirect()->route('expenses.index')->with('success', 'New expense created successfully!');
    }

    public function edit($id)
    {
        
    }

    public function update()
    {
        
    }

    public function delete($id)
    {
        
    }
}
