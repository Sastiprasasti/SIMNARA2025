@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-5 px-4">
        <div class="position-absolute top-0 end-0 opacity-10">
        </div>
        
        <div class="row align-items-center position-relative">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <div class="bps-logo-wrapper me-4">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="bps-logo">
                    </div>
                    <div class="border-start border-white border-opacity-25 ps-4">
                        <h2 class="display-6 fw-bold mb-1 typing-effect">Badan Pusat Statistik</h2>
                        <h2 class="display-6 fw-bold mb-1 typing-effect">Kabupaten Garut</h2>
                        <p class="lead mb-0 opacity-75" style="animation-delay: 3.5s;">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <a href="{{ route('templates.index') }}" class="btn btn-light rounded-pill px-4 py-2 d-inline-flex align-items-center shadow-hover">
                        <i class="fas fa-file-alt me-2"></i>Template
                    </a>
                    <a href="{{ route('pedoman.index') }}" class="btn btn-light rounded-pill px-4 py-2 d-inline-flex align-items-center shadow-hover">
                        <i class="fas fa-book me-2"></i>Pedoman
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-light rounded-pill px-4 py-2 d-inline-flex align-items-center shadow-hover">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sisa kode tetap sama -->
</div>

<style>
.shadow-hover {
    transition: all 0.3s ease;
}

.shadow-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.btn {
    font-size: 0.875rem;
    font-weight: 500;
}

/* Menyesuaikan ukuran ikon */
.btn i {
    font-size: 1rem;
}
</style>
    <!-- Main Content -->
    <div class="container-fluid px-4 py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Form Pengajuan Surat</h4>
                        <p class="text-muted mb-4">Ajukan dokumen resmi dengan mudah dan cepat melalui sistem kami.</p>
                        <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Pengajuan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-id-card fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Permohonan SPPD</h4>
                        <p class="text-muted mb-4">Proses pengajuan perjalanan dinas yang efisien dan terorganisir.</p>
                        <a href="{{ route('submissions.createForm2') }}" class="btn btn-success rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Permohonan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Form Kuitansi</h4>
                        <p class="text-muted mb-4">Kelola dan ajukan bukti pembayaran dengan sistem yang terintegrasi.</p>
                        <a href="{{ route('submissions.createForm3') }}" class="btn btn-danger rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Kuitansi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Submissions -->
        <div class="row g-4">
            <!-- Surat Tugas History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat Surat Tugas</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form1')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved' && $submission->admin_document_path)
    <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
       class="btn btn-primary btn-sm rounded-pill w-100"
       target="_blank">
        <i class="fas fa-download me-1"></i>Download Surat Balasan
    </a>
@else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan surat tugas</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- SPPD History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                                <i class="fas fa-id-card fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat SPPD</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form2')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                        <div class="dropdown">
                                            <button class="btn btn-link btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved' && $submission->admin_document_path)
    <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
       class="btn btn-success btn-sm rounded-pill w-100"
       target="_blank">
        <i class="fas fa-download me-1"></i>Download Surat Balasan
    </a>
@else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan SPPD</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kuitansi History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle p-3 me-3">
                                <i class="fas fa-receipt fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat Kuitansi</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form3')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                        <div class="dropdown">
                                            <button class="btn btn-link btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved')
                                    @if($submission->admin_document_path)
                                        <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
                                           class="btn btn-danger btn-sm rounded-pill w-100"
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download Surat Balasan
                                        </a>
                                    @endif
                                @else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan kuitansi</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modals -->
@foreach(Auth::user()->submissions()->latest()->take(15)->get() as $submission)
<div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <dl class="row g-3 mb-0">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusClass = match($submission->status) {
                                'approved' => 'success',
                                'pending' => 'warning',
                                default => 'danger'
                            };
                        @endphp
                        <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                            {{ ucfirst($submission->status) }}
                        </span>
                        
                        @if($submission->admin_remarks)
                            <div class="alert alert-light border mt-2 p-2 mb-0">
                                <small class="d-block fw-bold text-muted mb-1">Keterangan Admin:</small>
                                <p class="small mb-0">{{ $submission->admin_remarks }}</p>
                            </div>
                        @endif
                    </dd>

                    <!-- Rest of the modal content... -->
                </dl>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Styles -->
<style>
/* ===== Base Styles ===== */
/* CSS */
/* CSS */
:root {
    --primary: #4e73df;
    --primary-dark: #224abe;
    --success: #1cc88a;
    --danger: #e74a3b;
    --warning: #f6c23e;
    --bg-light: #f8f9fc;
    --bg-dark: #343a40;
    --text-muted: rgba(0, 0, 0, 0.6);
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-light);
    margin: 0;
    padding: 0;
    color: var(--text-muted);
}

/* ===== Layout & Container ===== */
.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    box-shadow: 0 4px 15px rgba(78, 115, 223, 0.2);
    color: white;
    animation: gradientShift 5s ease infinite;
}

@keyframes gradientShift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.container-dashboard {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

/* ===== Logo Styles ===== */
.bps-logo {
    height: 64px;
    width: auto;
    transition: transform 0.3s ease, filter 0.3s ease;
    filter: brightness(0.95);
    animation: logoSpin 5s linear infinite;
}

@keyframes logoSpin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(0deg);
    }
}

.bps-logo:hover {
    transform: scale(1.1);
    filter: brightness(1);
    animation: none;
}

.bps-logo-wrapper {
    background: rgb(255, 255, 255);
    padding: 1rem;
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.bps-logo-wrapper:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-4px);
}

/* ===== Card Effects ===== */
.card {
    border-radius: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    animation: cardEntrance 0.5s ease-out;
}

@keyframes cardEntrance {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.card-header {
    padding: 1rem;
    background: var(--primary);
    color: white;
    font-weight: bold;
}

.card-body {
    padding: 1rem;
    color: var(--text-muted);
}

/* ===== Buttons ===== */
.btn-primary {
    background: var(--primary);
    color: white;
    position: relative;
    overflow: hidden;
}

.btn-primary::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 300%;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0.5s ease;
}

.btn-primary:hover::after {
    transform: translate(-50%, -50%) scale(1);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
}

/* ===== Icon Box ===== */
.icon-box {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    box-shadow: 0 4px 10px rgba(78, 115, 223, 0.2);
    transition: all 0.3s ease;
    animation: iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.icon-box:hover {
    background: var(--primary-dark);
    transform: rotate(15deg) scale(1.1);
    box-shadow: 0 6px 15px rgba(78, 115, 223, 0.3);
    animation: none;
}

/* ===== Badge Styles ===== */
.badge {
    display: inline-block;
    padding: 0.4em 0.8em;
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    color: white;
    border-radius: 1rem;
    transition: all 0.3s ease;
    animation: badgePulse 2s infinite;
}

@keyframes badgePulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

.badge-primary {
    background: var(--primary);
}

.badge-primary:hover {
    background: var(--primary-dark);
    transform: scale(1.1);
    animation: none;
}
/* ===== Dropdown Menu ===== */
.dropdown-menu {
    min-width: 150px;
    padding: 0.5rem;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: dropdownSlide 0.3s ease;
}

@keyframes dropdownSlide {
    from {
        opacity: 0;
        transform: translateY(-15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 0.625rem 1rem;
    border-radius: 0.5rem;
    color: var(--text-muted);
    transition: background 0.2s ease, transform 0.2s ease;
}

.dropdown-item:hover {
    background: var(--bg-light);
    transform: translateX(5px);
}

/* ===== Scrollbar Styles ===== */
.submission-list {
    max-height: 600px;
    overflow-y: auto;
    padding-right: 8px;
    scrollbar-width: thin;
    scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
}

.submission-list::-webkit-scrollbar {
    width: 8px;
}

.submission-list::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.submission-list::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.5);
    transform: scale(1.2);
}

/* ===== Utility Classes ===== */
.transition-all {
    transition: all 0.3s ease;
}

.hover-scale {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.shadow-soft {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.shadow-soft:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.shadow-medium {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transition: box-shadow 0.3s ease;
}

.shadow-medium:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.shadow-large {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: box-shadow 0.3s ease;
}

.shadow-large:hover {
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.4);
}
</style>

<!-- Scripts -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltips.map(function (tooltip) {
        return new bootstrap.Tooltip(tooltip)
    });

    // Initialize modals
    var modals = [].slice.call(document.querySelectorAll('.modal'))
    modals.map(function (modal) {
        return new bootstrap.Modal(modal)
    });

    // Initialize dropdowns
    var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    dropdowns.map(function (dropdown) {
        return new bootstrap.Dropdown(dropdown)
    });

    // Handle delete form submissions with SweetAlert2
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pengajuan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>
@endpush
@endsection