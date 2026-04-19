    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-check2-square me-1"></i> TaskFlow
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    @auth
                        @if (auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin.task.index') ? 'active' : '' }}"
                                    href="{{ route('admin.task.index') }}">
                                    Tasks
                                </a>
                            </li>
                        @endif
                    @endauth

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">

                        @auth
                            @if (auth()->user()->role == 'admin')
                                <a href="{{ url('/admin/dashboard') }}" class="btn btn-light btn-sm px-3">
                                    Dashboard
                                </a>
                            @else
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-danger">
                                        Sign out
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ url('/login') }}" class="btn btn-light btn-sm px-3">
                                Login
                            </a>
                        @endauth

                    </li>

                </ul>

            </div>

        </div>
    </nav>
