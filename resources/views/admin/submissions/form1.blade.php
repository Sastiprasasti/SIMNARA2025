@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Form Pengajuan Surat</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('submissions.store') }}">
                        @csrf
                        <input type="hidden" name="jenis_form" value="form_pengajuan">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat KTP</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3"
                                required></textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Menimbang</label>
                            <textarea name="menimbang" class="form-control @error('menimbang') is-invalid @enderror"
                                rows="3" required></textarea>
                            @error('menimbang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tujuan Pengajuan Surat</label>
                            <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="3"
                                required></textarea>
                            @error('tujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="kepada-section">
                            <label class="form-label">Kepada</label>
                            <div class="mb-3">
                                <input type="text" name="kepada[0][nama]" class="form-control mb-2" placeholder="Nama"
                                    required>
                                <input type="text" name="kepada[0][nip_nik]" class="form-control mb-2"
                                    placeholder="NIP/NIK" required>
                                <input type="text" name="kepada[0][jabatan]" class="form-control mb-2"
                                    placeholder="Jabatan" required>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="add-kepada">Tambah Kepada</button>

                        <div class="mb-3">
                            <label class="form-label">Untuk</label>
                            <textarea name="untuk" class="form-control @error('untuk') is-invalid @enderror" rows="3"
                                required></textarea>
                            @error('untuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jangka Waktu</label>
                            <input type="text" name="jangka_waktu"
                                class="form-control @error('jangka_waktu') is-invalid @enderror"
                                placeholder="Contoh: 1 Januari - 31 Desember 2024" required>
                            @error('jangka_waktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('add-kepada').addEventListener('click', function() {
    const section = document.getElementById('kepada-section');
    const index = section.querySelectorAll('div.mb-3').length;
    const newFields = `
            <div class="mb-3">
                <input type="text" name="kepada[${index}][nama]" class="form-control mb-2" placeholder="Nama" required>
                <input type="text" name="kepada[${index}][nip_nik]" class="form-control mb-2" placeholder="NIP/NIK" required>
                <input type="text" name="kepada[${index}][jabatan]" class="form-control mb-2" placeholder="Jabatan" required>
            </div>
        `;
    section.insertAdjacentHTML('beforeend', newFields);
});
</script>
@endsection