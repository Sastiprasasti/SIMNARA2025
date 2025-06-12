@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pilih Jenis Form</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary">Form Pengajuan Surat</a>
                        <a href="{{ route('submissions.createForm2') }}" class="btn btn-success">Form Permohonan KTP</a>
                        <a href="{{ route('submissions.createForm3') }}" class="btn btn-info">Form Pengaduan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection