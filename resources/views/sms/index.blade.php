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
                                <h3 class="mb-0">Sms History</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sms.create')}}" class="btn btn-sm btn-primary">Create a message</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th> <!-- Added actions column -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allSms as $sms)
                                <tr>  <!-- Each user gets their own row -->
                                    <th scope="row">{{ $sms->id }}</th>  <!-- Use scope="row" for th in tbody -->
                                    <td>{{ $sms->phone_number }}</td>
                                    <td>{{ $sms->message }}</td>
                                    <td>{{ $sms->created_at }}</td>
                                    <td>
                                        <!-- Action buttons here -->
                                         <form action="" method="POST">
                                            @csrf

                                            @method('DELETE')

                                            <a  href="" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                         </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No sms history</td>
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
                <div class="d-flex mt-3 justify-content-center">
                    <a href="{{ route('sms.to-all') }}" class="btn btn-primary btn-lg"> Send To All</a>
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