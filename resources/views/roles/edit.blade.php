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
                                <h3 class="mb-0">Edit Role</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roles.index')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id)}}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            
                            <h6 class="heading-small text-muted mb-4">Roles Information</h6>
                            <div class="pl-lg-4">
                                
                                    <div>
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Name</label>
                                            <input type="text" id="name" name="name" 
                                                   class="form-control form-control-alternative" 
                                                   placeholder="i.e admin, manager" value="{{ old('name', $role->name) }}" required>
                                        </div>
                                    </div>

                        
                                   <div>
                                   <label class="form-control-label" for="permissions">Permissions</label>
                                   <br>
                                   @foreach($permissions as $permission)

                                  
                                   <input type="checkbox" name="permissions[{{ $permission->name}}]" value="{{ $permission->name}}" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                                    {{ $permission->name}}
                                    <br>
                                   @endforeach
                                   </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-plus mr-2"></i>Update Role
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