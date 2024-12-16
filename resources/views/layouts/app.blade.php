<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom sidebar styles */
        #sidebar {
            background-color: #343a40;
            min-height: 100vh;
            color: #ffffff;
        }

        #sidebar .nav-link {
            color: #dcdcdc;
            padding: 15px 20px;
            font-size: 1.1rem;
        }

        #sidebar .nav-link:hover {
            background-color: #495057;
            color: #ffffff;
        }

        #sidebar .nav-link i {
            margin-right: 10px;
        }

        #sidebar .sidebar-heading {
            padding: 15px 20px;
            font-size: 1.2rem;
            color: #adb5bd;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Adjust main content to fill remaining width */
        main {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 pt-3 d-md-block sidebar collapse bg-dark text-white" id="sidebar">
                <h5 class="mb-4"><i class="fas fa-cogs me-2"></i>Panel</h5>
                <ul class="nav flex-column">
                    @yield('sidebar-links')
                    <!-- Section untuk sidebar links -->
                </ul>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom card shadow-lg p-4">
                    <h1 class="h2">@yield('header')</h1> <!-- Section untuk header -->
                </div>
                @yield('content')
                <!-- Section untuk konten utama -->
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('scripts')
    <!-- Section untuk script tambahan -->
</body>

</html>