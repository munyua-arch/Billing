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
