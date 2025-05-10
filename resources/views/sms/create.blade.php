@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- You might want to add some header content here -->
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
                                <h3 class="mb-0">Send SMS</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sms.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('sms.store') }}" autocomplete="off" id="smsForm">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">SMS Details</h6>
                            
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="phone_number">Phone Number</label>
                                    <input type="tel" 
                                           id="phone_number" 
                                           name="phone_number" 
                                           class="form-control form-control-alternative @error('phone_number') is-invalid @enderror" 
                                           placeholder="07xxxxxxxx" 
                                           pattern="0[0-9]{9}"
                                           value="{{ old('phone_number') }}" 
                                           required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Format: 07xxxxxxxx (10 digits starting with 0)</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="message">Message</label>
                                    <textarea name="message" 
                                              id="message"
                                              class="form-control form-control-alternative @error('message') is-invalid @enderror"
                                              rows="4"
                                              maxlength="1600"
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Max 1600 characters</small>
                                    <div class="text-right">
                                        <span id="charCount">0</span>/1600
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary px-5" id="submitBtn">
                                    <i class="fas fa-mobile mr-2"></i>Send SMS
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
        #charCount {
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone_number');
            const messageInput = document.getElementById('message');
            const charCount = document.getElementById('charCount');
            const form = document.getElementById('smsForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Format phone number input
            phoneInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            
            // Character count for message
            messageInput.addEventListener('input', function() {
                charCount.textContent = this.value.length;
            });
            
            // Initialize character count
            charCount.textContent = messageInput.value.length;
            
            // Form submission handler
            form.addEventListener('submit', function(e) {
                // Validate phone number format
                const phoneRegex = /^0[0-9]{9}$/;
                if (!phoneRegex.test(phoneInput.value)) {
                    e.preventDefault();
                    alert('Please enter a valid phone number in the format 07xxxxxxxx');
                    return;
                }
                
                // Disable button to prevent multiple submissions
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            });
        });
    </script>
@endpush