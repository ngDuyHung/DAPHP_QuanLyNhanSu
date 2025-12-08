<style>
    @media (max-width: 1199.98px) {
        .navbar-collapse {
            background-color: #fff;
            padding: 1rem;
            border-radius: 0.375rem;
            box-shadow: 0 0.25rem 1rem rgba(161, 172, 184, 0.45);
            margin-top: 0.5rem;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        /* Ensure the navbar container handles the absolute positioning correctly */
        #layout-navbar {
            position: relative;
        }

        /* Adjust nav links spacing on mobile */
        .navbar-nav .nav-item .nav-link {
            padding: 0.5rem 0;
        }
    }
</style>

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    <div class="container-fluid px-0">

        <!-- Mobile Toggler -->
        <button class="navbar-toggler border-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <i class='bx bx-menu bx-sm'></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand fw-bold fs-4 me-auto" href="{{ route('client.home') }}">HRM Employee</a>
        <!-- /Brand -->

        <!-- User Dropdown (Mobile - Visible on right) -->
        <ul class="navbar-nav flex-row align-items-center ms-auto d-xl-none">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if(Auth::check() && isset(Auth::user()->employee) && Auth::user()->employee->img_link)
                        <img src="{{ asset('storage/' . Auth::user()->employee->img_link) }}" alt class="w-px-40 h-auto rounded-circle" />
                        @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if(isset($employee) && $employee->img_link)
                                        <img src="{{ asset('storage/' . $employee->img_link) }}" alt class="w-px-40 h-auto rounded-circle" />
                                        @else
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        @if(isset($employee))
                                        {{ $employee->full_name }}
                                        @else
                                        User
                                        @endif
                                    </span>
                                    <small class="text-muted">Employee</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav ms-xl-4 me-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold me-3 {{ request()->routeIs('client.home') ? 'active text-primary' : '' }}" href="{{ route('client.home') }}">
                        <i class='bx bx-home-alt me-1'></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold me-3 {{ request()->routeIs('client.salary.*') ? 'active text-primary' : '' }}" href="{{ route('client.salary.show', Auth::user()->employee->employee_id ?? 0) }}">
                        <i class='bx bx-money me-1'></i> Lương
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('client.leaves.*') ? 'active text-primary' : '' }}" href="{{ route('client.leaves.index', Auth::user()->employee->employee_id ?? 0) }}">
                        <i class='bx bx-calendar-minus me-1'></i> Nghỉ phép
                    </a>
                </li>
            </ul>

            <!-- User Dropdown (Desktop - Visible on right) -->
            <ul class="navbar-nav flex-row align-items-center ms-auto d-none d-xl-flex">
                <!--  Toggle Theme -->
                <!-- <li class="nav-item dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown" aria-label="Toggle theme (light)" aria-expanded="false">
                        <i class="bx bx-sun icon-base bx icon-md theme-icon-active"></i>
                        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                        <li>
                            <button type="button" class="dropdown-item align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                                <span><i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>Light</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                <span><i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>Dark</span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system" aria-pressed="false">
                                <span><i class="icon-base bx bx-desktop icon-md me-3" data-icon="desktop"></i>System</span>
                            </button>
                        </li>
                    </ul>
                </li> -->
                <!-- / Toggle Theme -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            @if(Auth::check() && isset(Auth::user()->employee) && Auth::user()->employee->img_link)
                            <img src="{{ asset('storage/' . Auth::user()->employee->img_link) }}" alt class="w-px-40 h-auto rounded-circle" />
                            @else
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            @if(isset($employee) && $employee->img_link)
                                            <img src="{{ asset('storage/' . $employee->img_link) }}" alt class="w-px-40 h-auto rounded-circle" />
                                            @else
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">
                                            @if(isset($employee))
                                            {{ $employee->full_name }}
                                            @else
                                            User
                                            @endif
                                        </span>
                                        <small class="text-muted">{{ Auth::user()->employee->position ?? 'Employee' }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        @if(Auth::check() && Auth::user()->role== 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">Dashboard</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</nav>