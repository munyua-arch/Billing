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
                                <h3 class="mb-0">Create Expense</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('expenses.index')}}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('expenses.store')}}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">Expense Information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="package">Expense Type</label>
                                            

                                            <select id="role" name="type" class="form-control form-control-alternative">
                                            <option>--Select Option--</option>
                                            <option value="Internet">Internet</option>
                                            <option value="Electricity">Electricity</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Bulk SMS">Bulk SMS</option>
                                            <option value="Airtime">Airtime</option>
                                            <option value="Other">Other</option>
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="phone">Amount</label>
                                            <input type="text" name="amount" 
                                                   class="form-control form-control-alternative" 
                                                 value="{{ old('amount') }}" required>
                                        </div>
                                    </div>
                                </div>
                                
                                    <div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Payment Gateway</label>
                                            <select name="method" class="form-control form-control-alternative">
                                                <option>Choose Option</option>
                                                <option value="Mpesa">Mpesa</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                                <option value="Cheque">Cheque</option>
                                            </select>
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