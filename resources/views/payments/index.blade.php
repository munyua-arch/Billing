@extends('layouts.app')

@section('content')
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
                                <h3 class="mb-0">Payments</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="#" class="btn btn-sm btn-primary">Record Payment</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Client</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Receipt NO.</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payed On</th>
                                    <th scope="col">Actions</th> <!-- Added actions column -->
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($payments as $payment)
                                <tr>  <!-- Each user gets their own row -->
                                    
                                    <td>{{ $payment->client}}</td>
                                    <td>{{ $payment->phone}}</td>
                                    <td>{{ $payment->receipt_no}} / {{ $payment->download_speed}}</td>
                                    <td>{{ $payment->amount}}</td>
                                    <td>{{ $payment->created_at}}</td>
                                   
                                    <td>
                                        <!-- Action buttons here -->
                                         <form action="#" method="POST">
                                            @csrf

                                            @method('DELETE')

                                            <a  href="#" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                         </form>
                                    </td>
                                </tr>
                               @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Payments found</td>
                                </tr>
                               @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-center   " aria-label="...">
                            <!-- Pagination would go here -->
                           {{ $payments->links() }}
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