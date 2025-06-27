@extends('admin.layouts.app')

@section('content')
<div class="container">
    <!-- Blue Header -->
    <div class="bg-primary text-white p-3 mb-4 rounded">
        <h4 class="mb-0">Surat Masuk</h4>
        <small>Sistem Informasi Manajemen Surat</small>
    </div>

    <!-- Form Tambah Surat Masuk -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Tambah Surat Masuk</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.surat-masuk.store') }}" id="formSuratMasuk" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Perihal</label>
                    <textarea name="perihal" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Disposisi</label>
                    <select name="disposisi" class="form-select" onchange="handleDisposisiChange(this)">
                        <option value="" disabled selected>Pilih disposisi</option>
                        <option value="Tidak Disposisi">Tidak Disposisi</option>
                        <option value="IPDS">Tim IPDS</option>
                        <option value="TU">TU (Umum)</option>
                        <option value="Kepala Kantor">Kepala Kantor</option>
                        <option value="Neraca">Neraca</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Distribusi">Distribusi</option>
                        <option value="Produksi">Produksi</option>
                    </select>
            </div>

                <div class="mb-3">
                    <label class="form-label">Upload PDF</label>
                    <input type="file" name="file_pdf" class="form-control" accept=".pdf" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Surat Masuk -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Surat Masuk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nomor Surat</th>
                            <th>Nama Pengirim</th>
                            <th>Perihal</th>
                            <th>Status Disposisi</th>
                            <th>PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suratMasuk as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->nama_pengirim }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>
                                @if($surat->status_disposisi === 'Disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($surat->status_disposisi === 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ Storage::url('surat_masuk/' . $surat->file_path) }}"
                                    class="btn btn-sm btn-primary"
                                    target="_blank">
                                    <i class="fas fa-file-pdf"></i> Lihat
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('surat-masuk.edit', $surat->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada surat masuk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

</script>
@endsection