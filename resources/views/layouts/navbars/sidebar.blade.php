<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <h1 class="text-blue">ISP Billing</h1>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                
                <!-- Members Section -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile*') || request()->is('user*') ? 'active' : '' }}" 
                       href="#members-collapse" 
                       data-toggle="collapse" 
                       role="button" 
                       aria-expanded="{{ request()->is('profile*') || request()->is('user*') ? 'true' : 'false' }}" 
                       aria-controls="members-collapse">
                        <i class="ni ni-single-02 text-primary"></i>
                        <span class="nav-link-text">{{ __('Staff') }}</span>
                    </a>

                    <div class="collapse {{ request()->is('profile*') || request()->is('user*') ? 'show' : '' }}" id="members-collapse">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                    <i class="ni ni-single-02 text-primary"></i> {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                                    <i class="ni ni-badge text-primary"></i> {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

               <!-- Clients Section -->
               <li class="nav-item">
                    <a class="nav-link {{ request()->is('client*') ? 'active' : '' }}" 
                       href="#clients-collapse" 
                       data-toggle="collapse" 
                       role="button" 
                       aria-expanded="{{ request()->is('client*') ? 'true' : 'false' }}" 
                       aria-controls="clients-collapse">
                        <i class="ni ni-circle-08 text-primary"></i>
                        <span class="nav-link-text">{{ __('Clients') }}</span>
                    </a>

                    <div class="collapse {{ request()->is('client*') ? 'show' : '' }}" id="clients-collapse">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('client*') ? 'active' : '' }}" href="{{ route('client.index') }}">
                                    <i class="ni ni-bullet-list-67 text-primary"></i> {{ __('Client Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Roles & Permissions Section -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" 
                       href="#roles-collapse" 
                       data-toggle="collapse" 
                       role="button" 
                       aria-expanded="{{ request()->is('roles*') ? 'true' : 'false' }}" 
                       aria-controls="roles-collapse">
                        <i class="ni ni-key-25 text-primary"></i>
                        <span class="nav-link-text">{{ __('Roles & Permissions') }}</span>
                    </a>

                    <div class="collapse {{ request()->is('roles*') ? 'show' : '' }}" id="roles-collapse">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('roles/index') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                    <i class="ni ni-ui-04 text-primary"></i> {{ __('Role Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                 <!-- Finances Section -->
                 <li class="nav-item">
                    <a class="nav-link {{ request()->is('finances*') || request()->is('payment*') || request()->is('expenses*') ? 'active' : '' }}" 
                       href="#finances-collapse" 
                       data-toggle="collapse" 
                       role="button" 
                       aria-expanded="{{ request()->is('finances*') || request()->is('payment*') || request()->is('expenses*') ? 'true' : 'false' }}" 
                       aria-controls="finances-collapse">
                        <i class="ni ni-money-coins text-primary"></i>
                        <span class="nav-link-text">{{ __('Finances') }}</span>
                    </a>

                    <div class="collapse {{ request()->is('finances*') || request()->is('payment*') || request()->is('expenses*') ? 'show' : '' }}" id="finances-collapse">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('finances/packages') ? 'active' : '' }}" href="{{ route('finance.packages')}}">
                                    <i class="ni ni-box-2 text-primary"></i> {{ __('Packages') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('payment*') ? 'active' : '' }}" href="{{ route('payment.index')}}">
                                    <i class="ni ni-credit-card text-primary"></i> {{ __('Payments') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('expenses*') ? 'active' : '' }}" href="{{ route('expenses.index')}}">
                                    <i class="ni ni-money-coins text-primary"></i> {{ __('Expenses') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sms') ? 'active' : '' }}" href="{{ route('sms.index')}}">
                        <i class="ni ni-send text-primary"></i> {{ __('Bulk Sms') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>