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
                                <h3 class="mb-0">Add New Member</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>

     
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store')}}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">Member Information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Full Name</label>
                                            <input type="text" id="name" name="name" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="John Doe" value="{{ old('name') }}" required>

                                                   @error('name')
                                                        <span class="text-danger text-sm" role="alert">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="phone">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="0700123456" value="{{ old('phone') }}" required maxlength="10">

                                            @error('phone')
                                                <span class="text-danger text-sm" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email Address</label>
                                            <input type="email" id="email" name="email" 
                                                   class="form-control form-control-alternative" value="{{ old('email') }}"
                                                   placeholder="john@example.com">

                                                   @error('email')
                                                <span class="text-danger text-sm" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="role">Member Role</label>
                                            

                                            <select id="role" name="role[]" class="form-control form-control-alternative">
                                            <option>--Select Role--</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id}}">{{ $role->name}}</option>

                                            @endforeach
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Password</label>
                                            <input type="password" id="name" name="password" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="********"  required>

                                            @error('password')
                                            
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message}}</strong>
                                            </span>

                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Confirm Password</label>
                                            <input type="password" id="name" name="password_confirmation" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="********"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">
                            
                           

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-user-plus mr-2"></i>Add Member
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