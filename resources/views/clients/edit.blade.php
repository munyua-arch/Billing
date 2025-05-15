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
                                <h3 class="mb-0">Edit Client</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('client.index')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('client.update', $client->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">Client Information</h6>
                            <div class="pl-lg-4">

                            <div class="form-group">
                                            <label class="form-control-label" for="role">Connection Type</label>
                                            

                                            <select id="role" name="connection_type" class="form-control form-control-alternative">
                                            <option>--Choose connection type--</option>
                                            <option value="PPPoE " {{ $client->connection_type == 'PPPoE' ? 'selected' : '' }}>PPPoE</option>
                                            <option value="Static " {{ $client->connection_type == 'Static' ? 'selected' : '' }}>Static</option>
                                            </select>
                                           
                                        </div>

                                <div class="row">


                                        

                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">First Name</label>
                                            <input type="text" id="name" name="first_name" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="John" value="{{ old('first_name', $client->first_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Last Name</label>
                                            <input type="text" id="name" name="last_name" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="Doe" value="{{ old('last_name', $client->last_name) }}" required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">username</label>
                                            <input type="text" id="name" name="username" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="Doe" value="{{ old('username', $client->username) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Password</label>
                                            <input type="password" id="password" name="password" 
                                                class="form-control form-control-alternative" 
                                                placeholder="Leave blank to keep current password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Expiry Date</label>
                                            <input type="date" id="name" name="expiry_date" 
                                                   class="form-control form-control-alternative" 
                                                   value="{{ old('expiry_date', $client->expiry_date) }}"
                                                    required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="role">Package</label>
                                            

                                            <select id="role" name="package" class="form-control form-control-alternative">
                                            <option>--Choose Package--</option>

                                           @foreach($packages as $package)
                                           <option value="{{$package->package_name}}" 
                                           {{ $client->package_name == $package->package_name ? 'selected' : '' }}>{{$package->package_name}}</option>
                                           @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>


                                       
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Phone</label>
                                            <input type="tel" id="name" name="phone_number" 
                                                   class="form-control form-control-alternative"  maxlength="10"
                                                   value="{{ old('phone_number', $client->phone_number) }}"
                                                    required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="role">Location</label>
                                            <input type="text" name="location"
                                            class="form-control form-control-alternative"
                                             value="{{ old('location', $client->location) }}"
                                            >
                                           
                                        </div>
                                    </div>


                                       
                                </div>
                            </div>

                            
                            
                           

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-user-plus mr-2"></i>Update Client
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