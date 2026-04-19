    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: #0d6efd;
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
            letter-spacing: .5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, .85) !important;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff !important;
        }

        main {
            flex: 1;
        }

        footer {
            background: #fff;
            border-top: 1px solid #e5e7eb;
        }
    </style>

    @stack('style')
