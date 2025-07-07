@extends('admin.layouts.app')

@section('content')
<form action="{{ route('surat-masuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $surat->tanggal->format('Y-m-d')) }}" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama Pengirim</label>
        <input type="text" name="nama_pengirim" class="form-control" value="{{ old('nama_pengirim', $surat->nama_pengirim) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Perihal</label>
        <textarea name="perihal" class="form-control" rows="3" required>{{ old('perihal', $surat->perihal) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Disposisi</label>
        <select name="disposisi" class="form-select" required>
            <option value="" disabled>Pilih disposisi</option>
            @foreach(['Tidak Disposisi', 'IPDS', 'TU', 'Kepala Kantor', 'Neraca', 'Sosial', 'Distribusi', 'Produksi'] as $unit)
                <option value="{{ $unit }}" {{ old('disposisi', $surat->disposisi) == $unit ? 'selected' : '' }}>
                    {{ $unit }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Upload PDF (opsional)</label>
        <input type="file" name="file_pdf" class="form-control" accept=".pdf">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection