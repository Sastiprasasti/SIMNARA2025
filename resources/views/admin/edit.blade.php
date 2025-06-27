<form action="{{ route('surat-masuk.update', $surat->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" value="{{ $surat->nomor_surat }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Pengirim</label>
        <input type="text" name="pengirim" value="{{ $surat->pengirim }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="{{ $surat->tanggal }}" class="form-control" required>
    </div>

    {{-- Tambah input lainnya sesuai kebutuhan --}}

    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>