<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    //
    public function index()
    {
        // Get paginated expenses
        $expenses = Expenses::latest()->paginate(10);
        
        // Calculate amounts and trends
        $counts = [
            // Total amounts
            'total_amount' => Expenses::sum('amount'),
            'monthly_amount' => Expenses::whereBetween('created_at', [
                                now()->startOfMonth(),
                                now()->endOfMonth()
                            ])->sum('amount'),
            'daily_amount' => Expenses::wherecreated_at('created_at', today())->sum('amount'),
            
            // Trends (percentage changes)
            'total_trend' => $this->calculateTrend('total'),
            'monthly_trend' => $this->calculateTrend('monthly'),
            'daily_trend' => $this->calculateTrend('daily')
        ];

        return view('expenses.index', compact('expenses', 'counts'));
    }

    private function calculateTrend($period)
    {
        $current = 0;
        $previous = 0;
        
        switch ($period) {
            case 'total':
                // Compare with last month
                $current = Expenses::whereMonth('created_at', now()->month)->sum('amount');
                $previous = Expenses::whereMonth('created_at', now()->subMonth()->month)->sum('amount');
                break;
                
            case 'monthly':
                // Compare with last week
                $current = Expenses::whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->sum('amount');
                
                $previous = Expenses::whereBetween('created_at', [
                    now()->subWeek()->startOfWeek(),
                    now()->subWeek()->endOfWeek()
                ])->sum('amount');
                break;
                
            case 'daily':
                // Compare with yesterday
                $current = Expenses::wherecreated_at('created_at', today())->sum('amount');
                $previous = Expenses::wherecreated_at('created_at', today()->subDay())->sum('amount');
                break;
        }
        
        return ($previous != 0) ? (($current - $previous) / $previous) * 100 : 0;
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
            'amount' => 'required|integer'
        ]); 

        Expenses::create($validated);

        return redirect()->route('expenses.index')->with('success', 'New expense created successfully!');
    }

    public function edit($id)
    {
        $expense = Expenses::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    public function upcreated_at(Request $request, $id)
    {
        $valicreated_atd = $request->valicreated_at([
            'type' => 'required|string|max:100',
            'method' => 'required|string|max:100',
            'amount' => 'required|string|max:100'
        ]); 

        $expense = Expenses::findOrFail($id);
        $expense->upcreated_at($valicreated_atd);

        return redirect()->route('expenses.index')->with('success', 'Expense upcreated_atd successfully!');
    }

    public function delete($id)
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense removed successfully!');
    }
}
