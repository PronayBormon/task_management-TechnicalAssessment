<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>

    @include('backend.partials.header')
    @include('backend.partials.styles')

</head>


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Navbar-->
        @include('backend.partials.navbar')
        <!--end::Navbar-->

        <!--begin::Sidebar-->
        @include('backend.partials.sidebar')
        <!--end::Sidebar-->

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('title', 'Tasks')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"> @yield('title', 'Dashboard')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content -->
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        @include('backend.partials.footer')
        <!--end::Footer-->
    </div>
    @include('backend.partials.script')


</body>
<!--end::Body-->

</html>
