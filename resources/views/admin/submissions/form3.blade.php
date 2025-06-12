@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Pengaduan</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('submissions.store') }}">
                        @csrf
                        <input type="hidden" name="jenis_form" value="form3">

                        <div class="mb-3">
                            <label class="form-label">Nama Pelapor</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi Kejadian</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Pengaduan</label>
                            <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="3" required></textarea>
                            @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection