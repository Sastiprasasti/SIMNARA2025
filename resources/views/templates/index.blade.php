@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-5 px-4">
        <div class="position-absolute top-0 end-0 opacity-10">
            <svg width="450" height="400" viewBox="0 0 200 200">
                <path fill="currentColor" d="M45,-78.1C58.3,-71.2,69.1,-57.7,73.3,-42.7C77.5,-27.7,75.1,-11.2,73.7,5.3C72.3,21.8,71.9,38.2,64.4,50.8C56.9,63.4,42.4,72.1,26.9,75.7C11.4,79.2,-5.1,77.6,-20.2,72.5C-35.3,67.4,-49,58.8,-57.7,46.7C-66.4,34.7,-70.1,19.1,-70.9,3.8C-71.7,-11.5,-69.5,-26.5,-62.3,-38.7C-55,-50.9,-42.7,-60.3,-29.7,-67.5C-16.7,-74.7,-3.1,-79.7,10.9,-79.7C24.8,-79.7,31.7,-85,45,-78.1Z" transform="translate(100 100)" />
            </svg>
        </div>
        
        <div class="row align-items-center position-relative">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <div class="bps-logo-wrapper me-4">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="bps-logo">
                    </div>
                    <div class="border-start border-white border-opacity-25 ps-4">
                        <h2 class="display-6 fw-bold mb-1">Template Dokumen</h2>
                        <p class="lead mb-0 opacity-75">Unduh template yang Anda butuhkan</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm hover-lift">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid px-4 py-5">
        <div class="row g-4 justify-content-center">
            <!-- Template SPPD -->
            <div class="col-md-5">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-id-card fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Template SPPD</h4>
                        <p class="text-muted mb-4">Format resmi Surat Perintah Perjalanan Dinas (SPPD) sesuai dengan standar yang berlaku di BPS.</p>
                        <a href="{{ route('templates.download.sppd') }}" class="btn btn-success rounded-pill w-100 py-3">
                            <i class="fas fa-download me-2"></i>Unduh Template
                        </a>
                    </div>
                </div>
            </div>

            <!-- Template Kuitansi -->
            <div class="col-md-5">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-receipt fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Template Kuitansi</h4>
                        <p class="text-muted mb-4">Format baku kuitansi untuk berbagai keperluan administrasi keuangan di lingkungan BPS.</p>
                        <a href="{{ route('templates.download.kuitansi') }}" class="btn btn-danger rounded-pill w-100 py-3">
                            <i class="fas fa-download me-2"></i>Unduh Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.bps-logo {
    height: 64px;
    width: auto;
}

.bps-logo-wrapper {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 1rem;
    backdrop-filter: blur(10px);
}

.shadow-hover {
    transition: all 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.transform-hover {
    transition: transform 0.3s ease;
}

.transform-hover:hover {
    transform: translateY(-5px);
}

.hover-lift {
    transition: transform 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
}

.icon-box {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-success-subtle { background-color: rgba(40, 167, 69, 0.1); }
.bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1); }
</style>
@endsection