<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'BPS Garut')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
        /* Base */
        body {
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 250px;
            z-index: 1000;
            padding: 20px;
        }

        /* Back Button */
        .back-button {
            color: #6c757d;
            padding: 12px 15px;
            border-radius: 5px;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            text-decoration: none;
        }

        .back-button i {
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .content-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 25px;
        }

        /* Cards & Alerts */
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 8px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            padding: 15px 20px;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Content -->
    <div class="content-wrapper">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')
</body>
</html>