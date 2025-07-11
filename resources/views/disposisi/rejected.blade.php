@extends('admin.layouts.app')

@section('content')
<div class="container">
    <!-- Blue Header -->
    <div class="bg-primary text-white p-3 mb-4 rounded">
        <h4 class="mb-0">Rejected - Surat Masuk</h4>
        <small>Sistem Informasi Manajemen Surat</small>
    </div>

      <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Pemberitahuan</h5>
        </div>
        <div class="card-body">
            <div class="container text-center py-5">
                <h2 class="text-danger"> ❌ Disposisi Ditolak</h2>
                <p>Anda telah menolak disposisi surat ini.</p>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary mt-3">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
    @endsection