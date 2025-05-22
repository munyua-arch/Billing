@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <div class="text-center">
                            <h2 class="text-primary mb-1">{{ __('Welcome Back') }}</h2>
                            <p class="text-lead text-muted">
                                {{ __('Sign in to your account') }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <!-- <div class="alert alert-info text-center">
                            <small>
                                <i class="ni ni-key-25 mr-1"></i>
                                Demo credentials: <strong>admin@gmail.com</strong> / <strong>secret12</strong>
                            </small>
                        </div> -->
                        
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="form-control-label text-muted">{{ __('Email Address') }}</label>
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="ni ni-email-83 text-primary"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                           placeholder="your@email.com" 
                                           type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-sm" role="alert">
                                        <small>{{ $errors->first('email') }}</small>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-control-label text-muted">{{ __('Password') }}</label>
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"><i class="ni ni-lock-circle-open text-primary"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                           name="password" 
                                           placeholder="********"
                                           type="password" 
                                           required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-sm" role="alert">
                                        <small>{{ $errors->first('password') }}</small>
                                    </span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheckLogin">
                                        <span class="text-muted">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-primary">
                                        <small>{{ __('Forgot password?') }}</small>
                                    </a>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block py-3">
                                    {{ __('Sign in') }}
                                    <i class="ni ni-send ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (Route::has('register'))
                    <div class="text-center mt-4">
                        <p class="text-muted">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="text-primary font-weight-bold">
                                {{ __('Create one') }}
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection