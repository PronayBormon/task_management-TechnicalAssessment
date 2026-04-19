<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | TaskFlow</title>
@include('frontend.partials.styles')

</head>

<body>

    <!-- Navbar -->
    @include('frontend.partials.navbar')



    <!-- Main Content -->
    <main class="py-5">
        @yield('content')
    </main>



    <!-- Footer -->




    @include('frontend.partials.footer')
    @include('frontend.partials.scripts')

</body>

</html>