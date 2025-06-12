<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar - BPS Garut</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
        :root {
            --primary-color: #1a73e8;
            --sidebar-bg: #ffffff;
            --body-bg: #f4f6f9;
            --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background-color: var(--sidebar-bg);
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            z-index: 1000;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .back-button {
            color: #6c757d;
            padding: 12px 15px;
            border-radius: 8px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: rgba(0,0,0,0.05);
            color: var(--primary-color);
        }

        .content-wrapper {
            margin-left: 260px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .top-header {
            background: linear-gradient(to right, var(--primary-color), #4285f4);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .stats-icon {
            background-color: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
        }

        .stats-content {
            flex-grow: 1;
        }

        .stats-value {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
        }

        .table-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
        }

        .table {
            margin-bottom: 0;
        }

        .btn-download {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }

            .content-wrapper {
                margin-left: 0;
                padding: 15px;
            }

            .stats-card {
                flex-direction: column;
                text-align: center;
            }

            .stats-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
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
        <div class="top-header">
            <h4 class="mb-2">Surat Keluar</h4>
            <div class="text-white-50">Sistem Informasi Manajemen Surat</div>
        </div>

        <div class="container-fluid px-0">
            <!-- Status Cards -->
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-value">{{ $totalSubmissions }}</div>
                            <div class="stats-label">Total Surat</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-value">{{ $pendingSubmissions }}</div>
                            <div class="stats-label">Menunggu</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-value">{{ $approvedSubmissions }}</div>
                            <div class="stats-label">Disetujui</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="stats-content">
                            <div class="stats-value">{{ $todaySubmissions }}</div>
                            <div class="stats-label">Hari Ini</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <h5 class="mb-4">Daftar Surat Keluar</h5>
                <div class="table-responsive">
                    <table class="table" id="suratTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Tujuan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($submissions as $submission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $submission->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $submission->nama }}</td>
                                    <td>{{ $submission->tujuan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : ($submission->status == 'approved' ? 'success' : 'danger') }}">
                                            {{ ucfirst($submission->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-{{ $submission->status == 'approved' ? 'primary' : 'secondary' }} btn-download" 
                                                {{ $submission->status != 'approved' ? 'disabled' : '' }}>
                                            <i class="fas fa-download"></i>
                                            Download
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                        <p class="mb-0 text-muted">Belum ada surat keluar</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#suratTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                pageLength: 10,
                ordering: true,
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [5] }
                ]
            });
        });
    </script>
</body>
</html>