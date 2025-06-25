@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-4 px-4 mb-4">
        <div class="position-absolute top-0 end-0 opacity-10">
        </div>
        
        <div class="row align-items-center position-relative">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="bps-logo-wrapper me-4">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="bps-logo">
                    </div>
                    <div class="border-start border-white border-opacity-25 ps-4">
                        <!-- Tambahkan margin-bottom kecil di sini -->
                        <div style="font-size: 2.5rem; font-weight: 600; letter-spacing: 0; margin-bottom: -0.5rem;">
                            <span style="color: #0056b3;">SIM</span><span style="color: #28a745;">NA</span><span style="color: #fd7e14;">RA</span>
                        </div>
                        <p class="mb-0 opacity-75" style="line-height: 1;">Sistem Manajemen Surat Keluar dan Surat Masuk</p>
                        <h4 class="fw-bold mb-1">Badan Pusat Statistik Kabupaten Garut</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm me-2 rounded-pill shadow-sm hover-lift">
                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                </a>
                <a href="{{ route('admin.submissions.index') }}" class="btn btn-warning btn-sm me-2 rounded-pill shadow-sm hover-lift">
                    <i class="fas fa-list me-1"></i> Submissions
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm hover-lift">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            
            <div class="card-body p-4" style=" pointer-events: none;">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="btn btn-warning w-90 rounded py-3 shadow-sm no-hover">
                            <p class="fas fa-user me-2 d-inline"></p> Dashboard Admin
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border0 bg-gradient-purple text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Total Users</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['total_users'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border0 bg-gradient-blue text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Pending</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['pending_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-gradient-green text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Approved</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['approved_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-gradient-blue text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Total Submissions</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['total_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surat Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <a href="{{ route('admin.surat-keluar') }}" class="text-decoration-none">
                    <div class="card border-0 bg-gradient-indigo text-white rounded-4 shadow-hover transform-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-2 opacity-75">Surat Keluar (Form 1)</p>
                                    <h3 class="mb-0 fw-bold">{{ $stats['surat_keluar'] }}</h3>
                                </div>
                                <div class="icon-box rounded-circle">
                                    <i class="fas fa-paper-plane fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('admin.surat-masuk') }}" class="text-decoration-none">
                    <div class="card border-0 bg-gradient-cyan text-white rounded-4 shadow-hover transform-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-2 opacity-75">Surat Masuk (Form 2 & 3)</p>
                                    <h3 class="mb-0 fw-bold">{{ $stats['surat_masuk'] }}</h3>
                                </div>
                                <div class="icon-box rounded-circle">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 rounded-4 shadow">
            <div class="card-header bg-white border-0 py-4">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.submissions.index') }}" class="btn btn-primary w-100 rounded-pill py-3 shadow-sm hover-lift">
                            <i class="fas fa-list me-2"></i> Manage Submissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Gradient background */
/* ===== Global Styles ===== */
body {
    font-family: 'Poppins', sans-serif;
    background-color:rgba(253, 253, 253, 0.37);
    color: #333;
}

/* ===== Header Section ===== */
.bg-gradient-primary {
    background: linear-gradient(45deg, #2575fc, #224abe);
    position: relative;
    overflow: hidden;
}

.bg-gradient-primary::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: rgb(#2575fc);
    clip-path: polygon(100% 0, 0 100%, 100% 100%);
    z-index: 1;
}

.bg-gradient-primary .row {
    position: relative;
    z-index: 2;
}

.bps-logo-wrapper {
    background: rgba(255, 255, 255, 0.94);
    padding: 0.75rem;
    border-radius: 0.75rem;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.bps-logo-wrapper:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-5px);
}

.bps-logo {
    height: 48px;
    width: auto;
    transition: transform 0.3s ease;
}

.bps-logo:hover {
    transform: scale(1.1);
}

.border-start {
    border-left: 2px solid rgba(255, 255, 255, 0.25) !important;
}

.btn-light {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-light:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
}

/* ===== Stats Cards ===== */
.card {
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.bg-gradient-purple {
    background: linear-gradient(45deg, #2575fc, #2575fc);
}

.bg-gradient-blue {
    background: linear-gradient(45deg, #2575fc, #2575fc);
}

.bg-gradient-green {
    background: linear-gradient(45deg, #2575fc, #2575fc);
}

.bg-gradient-indigo {
    background: linear-gradient(45deg, #2575fc, #2575fc);
}

.bg-gradient-cyan {
    background: linear-gradient(45deg, #2575fc, #2575fc);
}

.icon-box {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
    background: rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.icon-box:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(15deg) scale(1.1);
}

/* ===== Quick Actions ===== */
.quick-actions .btn {
    font-weight: 600;
    font-size: 1rem;
    padding: 1rem;
    transition: all 0.3s ease;
}

.quick-actions .btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* ===== Animations ===== */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

/* ===== Utility Classes ===== */
.hover-lift {
    transition: transform 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
}

.shadow-hover {
    transition: box-shadow 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

/* ===== Scrollbar Styles ===== */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
@endsection