@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Permohonan KTP</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('submissions.store') }}">
                        @csrf
                        <input type="hidden" name="jenis_form" value="form2">

                        <div class="mb-3">
                            <label class="form-label">Nama Pemohon</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Domisili</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Permohonan</label>
                            <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="3" required></textarea>
                            @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection