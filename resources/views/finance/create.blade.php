@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
               
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Create Packages</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('finance.packages')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('finance.store')}}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">Package Information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="package">Package Type</label>
                                            

                                            <select id="role" name="package_type" class="form-control form-control-alternative">
                                            <option>--Select Packages--</option>
                                            <option value="PPPoE">PPPoE</option>
                                            <option value="Static">Static</option>
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="phone">Package Name</label>
                                            <input type="text" name="package_name" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="Eg. 15Mbps Unlimited" value="{{ old('package_name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Duration</label>
                                            <select name="duration" class="form-control form-control-alternative">
                                                <option>Choose Duration</option>
                                                <option value="7d">1 Week</option>
                                                <option value="14d">2 Weeks</option>
                                                <option value="21d">3 Week</option>
                                                <option value="30d">30 Days</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="role">Price</label>
                                            <input type="text" name="price" class="form-control form-control-alternative" placeholder="Eg. KES 2,000">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Upload Speed</label>
                                            <input type="text" id="name" name="upload_speed" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="Eg. 5M"  required>

                                            @error('password')
                                            
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message}}</strong>
                                            </span>

                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Download Speed</label>
                                            <input type="text" id="name" name="download_speed" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="Eg. 5M"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-plus mr-2"></i>Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('css')
    <style>
        .form-control-alternative {
            transition: all 0.3s;
        }
        .form-control-alternative:focus {
            border-color: #5e72e4;
            box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
        }
        .card {
            border: 0;
            border-radius: 0.375rem;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format phone number input
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endpush