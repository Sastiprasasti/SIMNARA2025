@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">History Submissions</h5>
            <div class="btn-group" role="group" aria-label="Submission Forms">
                <a href="{{ route('submissions.createForm1') }}" class="btn btn-outline-light btn-sm d-flex align-items-center">
                    <i class="fas fa-file me-2"></i>Surat
                </a>
                <a href="{{ route('submissions.createForm2') }}" class="btn btn-outline-light btn-sm d-flex align-items-center">
                    <i class="fas fa-id-card me-2"></i>KTP
                </a>
                <a href="{{ route('submissions.createForm3') }}" class="btn btn-outline-light btn-sm d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>Kuitansi
                </a>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Jenis Form</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($latestSubmission)
                            <tr>
                                <td class="text-center fw-bold">1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                        {{ $latestSubmission->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </td>
                                <td>
                                    @if($latestSubmission->jenis_form == 'form1')
                                        <span class="badge bg-primary">Pengajuan Surat</span>
                                    @elseif($latestSubmission->jenis_form == 'form2')
                                        <span class="badge bg-success">Permohonan SPPD</span>
                                    @else
                                        <span class="badge bg-danger">Pengaduan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($latestSubmission->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($latestSubmission->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detail-{{ $latestSubmission->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        @if($latestSubmission->status == 'approved')
                                            <a href="{{ route('admin.submissions.pdf', $latestSubmission) }}" class="btn btn-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detail-{{ $latestSubmission->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Detail Submission</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4">Nama</dt>
                                                <dd class="col-sm-8">{{ $latestSubmission->nama }}</dd>

                                                <dt class="col-sm-4">Alamat</dt>
                                                <dd class="col-sm-8">{{ $latestSubmission->alamat }}</dd>

                                                <dt class="col-sm-4">Tujuan</dt>
                                                <dd class="col-sm-8">{{ $latestSubmission->tujuan }}</dd>

                                                <dt class="col-sm-4">Status</dt>
                                                <dd class="col-sm-8">
                                                    @if($latestSubmission->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($latestSubmission->status == 'approved')
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p class="mb-0">Belum ada submission</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection