<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        {{-- Left Navbar --}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>


        {{-- Right Navbar --}}
        <ul class="navbar-nav ms-auto">

            {{-- Fullscreen --}}
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none"></i>
                </a>
            </li>


            {{-- User Dropdown --}}
            <li class="nav-item dropdown user-menu">

                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline fw-semibold">
                        {{ Auth::user()->name }}
                    </span>
                </a>


                <ul class="dropdown-menu dropdown-menu-end">

                    <li class="dropdown-header text-center">
                        {{ Auth::user()->name }}
                        <small class="d-block text-muted">
                            Member since {{ Auth::user()->created_at->format('d M Y') }}
                        </small>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li class="px-3 pb-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger w-100">
                                Sign out
                            </button>
                        </form>
                    </li>

                </ul>

            </li>

        </ul>

    </div>
</nav>