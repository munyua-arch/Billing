@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <!-- Total Expenses Card -->
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Expenses</h5>
                                    <span class="h2 font-weight-bold mb-0">KSH {{ number_format($counts['total_amount'], 2) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="{{ ($counts['total_trend'] >= 0) ? 'text-success' : 'text-warning' }} mr-2">
                                    <i class="fas {{ ($counts['total_trend'] >= 0) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> 
                                    {{ abs($counts['total_trend'] ?? 0) }}%
                                </span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Monthly Expenses Card -->
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Monthly Expenses</h5>
                                    <span class="h2 font-weight-bold mb-0">KSH {{ number_format($counts['monthly_amount'] ?? 0, 2) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="{{ ($counts['monthly_trend'] >= 0) ? 'text-success' : 'text-warning' }} mr-2">
                                    <i class="fas {{ ($counts['monthly_trend'] >= 0) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> 
                                    {{ abs($counts['monthly_trend'] ?? 0) }}%
                                </span>
                                <span class="text-nowrap">Since last week</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Daily Expenses Card -->
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Daily Expenses</h5>
                                    <span class="h2 font-weight-bold mb-0">KSH {{ number_format($counts['daily_amount'] ?? 0, 2) }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="{{ ($counts['daily_trend'] >= 0) ? 'text-success' : 'text-warning' }} mr-2">
                                    <i class="fas {{ ($counts['daily_trend'] >= 0) ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> 
                                    {{ abs($counts['daily_trend'] ?? 0) }}%
                                </span>
                                <span class="text-nowrap">Since yesterday</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Header Section -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            
        @if(session('success'))    
            <div class="header-body">
                <div class="alert alert-success" role="alert">
                {{ session('success')}}
                </div>
            </div>
        @endif

        @if(session('error'))
        <div class="header-body">
                <div class="alert alert-danger" role="alert">
                {{ session('success')}}
                </div>
            </div>
        @endif
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Expenses</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('expenses.create')}}" class="btn btn-sm btn-primary">Create Expense</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Mode Of Payment</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th> <!-- Added actions column -->
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($expenses as $expense)
                                <tr>  <!-- Each user gets their own row -->
                                    
                                    <td>{{ $expense->type}}</td>
                                    <td>{{ $expense->amount}}</td>
                                    <td>{{ $expense->method}}</td>
                                    <td>{{ $expense->created_at}}</td>
                                   
                                    <td>
                                        <!-- Action buttons here -->
                                         <form action="{{ route('expenses.delete', $expense->id) }}" method="POST">
                                            @csrf

                                            @method('DELETE')

                                            <a  href="{{ route('expenses.edit', $expense->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                         </form>
                                    </td>
                                </tr>
                               @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Expenses found</td>
                                </tr>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <!-- Pagination would go here -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Any page-specific JavaScript would go here -->
    <script>
        // Example JS for this page
        document.addEventListener('DOMContentLoaded', function() {
            // Page-specific JavaScript
        });
    </script>
@endpush