@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Detail Submission</h3>
            <span class="badge {{ $submission->status === 'pending' ? 'bg-warning' : 
                                   ($submission->status === 'approved' ? 'bg-success' : 'bg-danger') }}">
                @switch($submission->status)
                    @case('pending')
                        Pending
                        @break
                    @case('approved')
                        Disetujui
                        @break
                    @case('rejected')
                        Ditolak
                        @break
                @endswitch
            </span>
        </div>
        
        <div class="card-body">
            <div class="row">
                {{-- Submission Information Column --}}
                <div class="col-md-6">
                    <h4 class="mb-3 border-bottom pb-2">Informasi Submission</h4>
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $submission->id }}</dd>

                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8">{{ $submission->nama }}</dd>

                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $submission->alamat }}</dd>

                        <dt class="col-sm-4">Tujuan</dt>
                        <dd class="col-sm-8">{{ $submission->tujuan }}</dd>

                        <dt class="col-sm-4">Jenis Form</dt>
                        <dd class="col-sm-8">
                            @switch($submission->jenis_form)
                                @case('form1')
                                    Surat Keluar
                                    @break
                                @case('form2')
                                @case('form3')
                                    Surat Masuk
                                    @break
                            @endswitch
                        </dd>

                        @if($submission->catatan)
                            <dt class="col-sm-4">Catatan</dt>
                            <dd class="col-sm-8">{{ $submission->catatan }}</dd>
                        @endif
                    </dl>
                </div>

                {{-- Action Buttons Column --}}
                <div class="col-md-6">
                    <h4 class="mb-3 border-bottom pb-2">Aksi</h4>
                    <div class="d-grid gap-3">
                        {{-- Preview PDF Button --}}
                        <a href="{{ route('admin.submissions.preview', $submission) }}" 
                           class="btn btn-outline-primary">
                            <i class="fas fa-file-pdf me-2"></i>Lihat Preview PDF
                        </a>

                        {{-- Pending Status Actions --}}
                        @if($submission->status === 'pending')
                            {{-- Approve Button --}}
                            <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-2"></i>Setujui Submission
                                </button>
                            </form>

                            {{-- Reject Button with Optional Note --}}
                            <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                
                                <div class="mb-3">
                                    <textarea name="catatan" class="form-control" rows="3" 
                                        placeholder="Berikan catatan penolakan (opsional)"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-2"></i>Tolak Submission
                                </button>
                            </form>

                        {{-- Approved Status Actions --}}
                        @elseif($submission->status === 'approved')
                            <a href="{{ route('admin.submissions.pdf', $submission) }}" 
                               class="btn btn-outline-success">
                                <i class="fas fa-download me-2"></i>Download PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection