<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Gaya kustom dari konfigurasi Anda sebelumnya */
        .sidebar {
            width: 250px;
            background-color: #4e342e;
            color: #fdf8f2;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #fdf8f2;
        }

        .sidebar-link {
            color: #fdf8f2;
            padding: 10px 15px;
            display: block;
            border-radius: 6px;
            margin-bottom: 8px;
            transition: background-color 0.3s;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar h1 {
            color: #f7e4b3;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        @include('admin.shared.left_sidebar')
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
