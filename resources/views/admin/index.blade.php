@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">History Submissions</h5>
            <div>
                <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-file me-1"></i>Form Surat
                </a>
                <a href="{{ route('submissions.createForm2') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-id-card me-1"></i>Form KTP
                </a>
                <a href="{{ route('submissions.createForm3') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-exclamation-circle me-1"></i>Form Pengaduan
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis Form</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($submission->jenis_form == 'form1')
                                        <span class="badge bg-primary">Pengajuan Surat</span>
                                    @elseif($submission->jenis_form == 'form2')
                                        <span class="badge bg-success">Permohonan KTP</span>
                                    @else
                                        <span class="badge bg-danger">Pengaduan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($submission->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    
                                    @if($submission->status == 'approved')
                                        <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download"></i> PDF
                                        </a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Submission</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">Nama</th>
                                                    <td>{{ $submission->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>{{ $submission->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tujuan</th>
                                                    <td>{{ $submission->tujuan }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ ucfirst($submission->status) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada submission yang telah disubmit</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection