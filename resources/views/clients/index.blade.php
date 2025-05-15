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
                                <h3 class="mb-0">Clients</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client.create') }}" class="btn btn-sm btn-primary">Add Client</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Userame</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Package</th>
                                    <th scope="col">Expiry</th>
                                    <th scope="col">Action</th> <!-- Added actions column -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                <tr>  <!-- Each user gets their own row --> <!-- Use scope="row" for th in tbody -->
                                    <td>{{ $client->username }}</td>
                                    <td>{{ $client->phone_number }}</td>
                                    <td>{{ $client->location }}</td>
                                    <td>{{ $client->package }}</td>
                                    <td>{{ \Carbon\Carbon::parse($client->expiry_date)->format('d/M/Y')}}</td>
                                   
                                    <td>
                                        <!-- Action buttons here -->
                                         <form action="{{ route('client.destroy', $client->id)}}" method="POST">
                                            @csrf

                                            @method('DELETE')

                                            <a  href="{{ route('client.edit', $client->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                         </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No clients found</td>
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