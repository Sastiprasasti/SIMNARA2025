@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Navigation -->
    <div class="container-fluid bg-light py-3 mb-4">
        <div class="container">
            <div class="d-flex align-items-center">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
                <h4 class="mb-0">Pedoman Penggunaan Sistem</h4>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            <!-- Pedoman Penggunaan -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-book-open me-3"></i>
                        <h5 class="mb-0">Pedoman Penggunaan</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="accordion" id="pedomanAccordion">
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pedoman1">
                                        Pedoman Surat Tugas
                                    </button>
                                </h2>
                                <div id="pedoman1" class="accordion-collapse collapse show" data-bs-parent="#pedomanAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/surat-tugas-step1.jpg" class="img-fluid rounded mb-2" alt="Step 1">
                                                <p class="text-muted">1. Klik tombol "Form Pengajuan Surat" pada halaman dashboard</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/surat-tugas-step2.jpg" class="img-fluid rounded mb-2" alt="Step 2">
                                                <p class="text-muted">2. Isi formulir dengan lengkap dan benar</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/surat-tugas-step3.jpg" class="img-fluid rounded mb-2" alt="Step 3">
                                                <p class="text-muted">3. Lampirkan dokumen pendukung jika diperlukan</p>
                                            </div>
                                            <div class="col-12">
                                                <img src="/path/to/surat-tugas-step4.jpg" class="img-fluid rounded mb-2" alt="Step 4">
                                                <p class="text-muted">4. Klik tombol "Submit" untuk mengirim pengajuan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0 mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pedoman2">
                                        Pedoman SPPD
                                    </button>
                                </h2>
                                <div id="pedoman2" class="accordion-collapse collapse" data-bs-parent="#pedomanAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/sppd-step1.jpg" class="img-fluid rounded mb-2" alt="Step 1">
                                                <p class="text-muted">1. Klik tombol "Permohonan SPPD" pada halaman dashboard</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/sppd-step2.jpg" class="img-fluid rounded mb-2" alt="Step 2">
                                                <p class="text-muted">2. Isi detail perjalanan dinas dengan lengkap</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/sppd-step3.jpg" class="img-fluid rounded mb-2" alt="Step 3">
                                                <p class="text-muted">3. Pastikan tanggal dan tujuan perjalanan sudah benar</p>
                                            </div>
                                            <div class="col-12">
                                                <img src="/path/to/sppd-step4.jpg" class="img-fluid rounded mb-2" alt="Step 4">
                                                <p class="text-muted">4. Submit formulir untuk memproses pengajuan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pedoman3">
                                        Pedoman Kuitansi
                                    </button>
                                </h2>
                                <div id="pedoman3" class="accordion-collapse collapse" data-bs-parent="#pedomanAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/kuitansi-step1.jpg" class="img-fluid rounded mb-2" alt="Step 1">
                                                <p class="text-muted">1. Klik tombol "Form Kuitansi" pada dashboard</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/kuitansi-step2.jpg" class="img-fluid rounded mb-2" alt="Step 2">
                                                <p class="text-muted">2. Isi informasi pembayaran dengan teliti</p>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <img src="/path/to/kuitansi-step3.jpg" class="img-fluid rounded mb-2" alt="Step 3">
                                                <p class="text-muted">3. Lampirkan bukti pendukung jika ada</p>
                                            </div>
                                            <div class="col-12">
                                                <img src="/path/to/kuitansi-step4.jpg" class="img-fluid rounded mb-2" alt="Step 4">
                                                <p class="text-muted">4. Review dan submit kuitansi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Tutorial -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm">
                    <div class="card-header bg-success text-white d-flex align-items-center">
                        <i class="fas fa-video me-3"></i>
                        <h5 class="mb-0">Video Tutorial</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="https://www.youtube.com/embed/contohlink1" title="Tutorial Surat Tugas" allowfullscreen></iframe>
                                        </div>
                                        <h5 class="card-title">Surat Tugas</h5>
                                        <p class="card-text small text-muted">Tutorial pengajuan surat tugas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="https://www.youtube.com/embed/contohlink2" title="Tutorial SPPD" allowfullscreen></iframe>
                                        </div>
                                        <h5 class="card-title">SPPD</h5>
                                        <p class="card-text small text-muted">Tutorial perjalanan dinas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <div class="ratio ratio-16x9 mb-3">
                                            <iframe src="https://www.youtube.com/embed/contohlink3" title="Tutorial Kuitansi" allowfullscreen></iframe>
                                        </div>
                                        <h5 class="card-title">Kuitansi</h5>
                                        <p class="card-text small text-muted">Tutorial pembuatan kuitansi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.accordion-button {
    background-color: rgba(78, 115, 223, 0.1);
    border: none;
    box-shadow: none;
}

.accordion-button:not(.collapsed) {
    background-color: rgba(78, 115, 223, 0.2);
    color: var(--primary);
    box-shadow: none;
}

.accordion-button::after {
    background-size: 1rem;
    transition: transform 0.3s ease;
}

.accordion-body {
    background-color: rgba(78, 115, 223, 0.05);
    border-radius: 0 0 0.5rem 0.5rem;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
</style>
@endsection