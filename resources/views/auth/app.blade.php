<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    @include('auth.partials.header')
    @include('auth.partials.styles')
</head>

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('home') }}"><b>Admin</a>
        </div>
        @yield('content')
    </div>

    @include('auth.partials.script')
</body>

</html>
