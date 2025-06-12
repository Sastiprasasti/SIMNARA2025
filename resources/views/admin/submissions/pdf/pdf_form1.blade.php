<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Surat Tugas</title>
    <style>
    @page {
        size: A4;
        margin: 2.5cm;
    }

    body {
        font-family: "Times New Roman", serif;
        font-size: 12pt;
        line-height: 1.5;
        margin: 3;
        padding: 2;
    }

    /* Tambah style khusus untuk logo */
    .header img {
        width: 50px; /* Sesuaikan ukuran yang diinginkan */
        height: auto;
        margin-bottom: 5px;
    }

    .container {
        max-width: 21cm;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Style lainnya tetap sama */
    .header-instansi {
        font-weight: bold;
        font-size: 12pt;
        margin: 5px 0;
    }
    .container {
        max-width: 21cm;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header-instansi {
        font-weight: bold;
        font-size: 12pt;
        margin: 5px 0;
    }

    .header-jenis {
        font-weight: bold;
        text-decoration: underline;
        font-size: 12pt;
        margin: 5px 0;
    }

    .header-nomor {
        font-size: 12pt;
        margin: 5px 0;
    }

    .section {
        margin-bottom: 10px;
    }

    .page-break {
        page-break-before: always;
    }

    .lampiran-title {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .lampiran-header {
        margin-bottom: 20px;
    }

    .lampiran-nomor {
        margin-bottom: 10px;
    }

    .recipient-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .recipient-table th,
    .recipient-table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .recipient-table th {
        background-color: #f2f2f2;
    }

    .kepada-section .content {
        margin-left: -20px;
        /* Sesuaikan margin untuk konten Kepada */
    }

    .row {
        position: relative;
        padding-left: 130px;
        min-height: 20px;
    }

    .label {
        position: absolute;
        left: 0;
        width: 110px;
    }

    .colon {
        position: absolute;
        left: 110px;
        width: 20px;
    }

    .content {
        text-align: justify;
    }

    .list-dasar {
        margin: 0;
        padding-left: 17px;
    }

    .list-dasar li {
        text-align: justify;
        margin-bottom: 5px;
        padding-left: 13px;
    }

    .memberi-perintah {
        text-align: center;
        font-weight: bold;
        margin: 15px 0;
    }

    .section {
        margin-bottom: 3px;
        /* Kurangi margin bottom */
    }

    .data-pegawai {
        margin-bottom: 5px;
        position: relative;
    }

    .data-label {
        display: inline-block;
        width: 80px;
        margin-left: 20px;
        /* Berikan margin untuk label data */
    }

    .data-colon {
        display: inline-block;
        width: 15px;
    }

    .data-content {
        display: inline-block;
    }

    .ttd {
        margin-top: 20px;
        /* Naikkan margin top dari 12px ke 20px */
        position: relative;
        float: right;
        width: 270px;
        margin-right: -20px;
        /* Kurangi margin kanan dari 10px ke 0px untuk geser ke kanan */
        padding-right: 0;
        /* Pastikan tidak ada padding yang mengganggu */
    }

    .ttd p {
        margin: 2px 0;
        /* Ubah margin ke lebih spesifik */
        line-height: 1.1;
        padding-right: 100px;
        /* Tambah padding kanan untuk geser teks */
    }

    .ttd .jabatan {
        text-align: center;
        margin-bottom: 50px;
    }

    .ttd .nama {
        text-align: center;
        margin-bottom: 3px;
    }

    .ttd .nip {
        text-align: center;
        letter-spacing: -0.8px;
        /* Kurangi sedikit jarak antar huruf jika perlu */
    }

    .clear {
        clear: both;
        /* Tambahkan clear untuk menghindari overlap */
        height: 10px;
        /* Berikan sedikit ruang */
    }

    .footer {
        clear: both;
        position: relative;
        text-align: center;
        font-size: 8pt;
        line-height: 1.2;
        margin-top: 75px;
        /* Naikkan margin top dari 35px ke 55px */
        width: 100%;
    }

    .footer p {
        margin: 0;
        text-align: center;
    }

    .footer .alamat {
        margin-bottom: 3px;
    }

    .footer a {
        color: #000;
        text-decoration: none;
    }
    </style>
</head>

<body>
    {{-- Halaman Pertama --}}
    <div class="container">
        <!-- Konten halaman pertama tetap sama... -->
        <div class="header">
            <img src="{{ public_path('images/logo-bps.png') }}" alt="Logo Badan Pusat Statistik Garut 2">
            <div class="header-instansi">BADAN PUSAT STATISTIK KABUPATEN GARUT</div>
            <div class="header-jenis">SURAT TUGAS</div>
            <div class="header-nomor">Nomor: B-0736/32051/VS.300/2024</div>
        </div>

        <div class="section">
            <div class="row">
                <div class="label">Menimbang</div>
                <div class="colon">:</div>
                <div class="content">
                    {{ $submission->menimbang }}
                </div>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="label">Mengingat</div>
                <div class="colon">:</div>
                <div class="content">
                    <ol class="list-dasar">
                        <li>Undang-Undang No. 16 Tahun 1997 Tentang Statistik;</li>
                        <li>Peraturan Pemerintah RI No. 51 Tahun 1999, Tentang Penyelenggaraan Statistik;</li>
                        <li>Keputusan Presiden RI No. 166 Tahun 2000;</li>
                        <li>Peraturan Pemerintah No. 86 Tahun 2007 tentang Badan Pusat Statistik;</li>
                        <li>Peraturan Kepala Badan Pusat Statistik Nomor 116 Tahun 2014 tentang Organisasi dan Tata
                            Kerja Badan Pusat Statistik;</li>
                        <li>Peraturan Badan Pusat Statistik No. 8 Tahun 2020 tentang Organisasi dan Tata Kerja Badan
                            Pusat Statistik Provinsi dan Badan Pusat Statistik Kabupaten/Kota;</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="memberi-perintah">Memberi Perintah</div>

        @if(count($kepada) > 1)
        <div class="section">
            <div class="row">
                <div class="label">Kepada</div>
                <div class="colon">:</div>
                <div class="content" style="font-style: italic;">Terlampir</div>
            </div>
        </div>
        @else
        <div class="section">
            <div class="row">
                <div class="label">Kepada</div>
                <div class="colon">:</div>
                <div class="content">
                    <div class="data-pegawai">
                        <div class="data-label">Nama</div>
                        <div class="data-colon">:</div>
                        <div class="data-content">{{ $kepada[0]['nama'] ?? '' }}</div>
                    </div>
                    <div class="data-pegawai">
                        <div class="data-label">NIP/NIK</div>
                        <div class="data-colon">:</div>
                        <div class="data-content">{{ $kepada[0]['nip_nik'] ?? '' }}</div>
                    </div>
                    <div class="data-pegawai">
                        <div class="data-label">Jabatan</div>
                        <div class="data-colon">:</div>
                        <div class="data-content">{{ $kepada[0]['jabatan'] ?? '' }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="section">
            <div class="row">
                <div class="label">Untuk</div>
                <div class="colon">:</div>
                <div class="content">{{ $submission->tujuan }}</div>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="label">Jangka Waktu</div>
                <div class="colon">:</div>
                <div class="content">{{ $submission->jangka_waktu }}</div>
            </div>
        </div>

        <div class="ttd">
            <p class="tanggal">Garut, {{ \Carbon\Carbon::parse($submission->tanggal)->translatedFormat('d F Y') }}</p>
            <p class="jabatan">Kepala,</p>
            <p class="nama">Nevi Hendri, S.Si, M.M.</p>
            <p class="nip">NIP. 19721130 199203 1 001</p>
        </div>

        <div class="footer">
            <p class="alamat">Jalan Pembangunan No. 222 Tarogong Kidul, Garut, Jawa Barat - Indonesia Kode Pos 44151</p>
            <p class="kontak">Telp.: (0262) 233273 Fax: (0262) 4893051 e-mail: <a
                    href="mailto:bps3205@bps.go.id">bps3205@bps.go.id</a> homepage: garutkab.bps</p>
        </div>
    </div>

    {{-- Halaman Kedua (Lampiran) hanya ditampilkan jika ada lebih dari 1 penerima --}}
    @if(count($kepada) > 1)
    <div class="page-break">
        <div class="lampiran-header">
            <div class="lampiran-nomor">Lampiran Surat Tugas</div>
            <div>Nomor: B-0736/32051/VS.300/2024</div>
            <div>Tanggal: {{ \Carbon\Carbon::parse($submission->tanggal)->translatedFormat('d F Y') }}</div>
        </div>

        <div class="lampiran-title">DAFTAR PEGAWAI YANG DITUGASKAN</div>

        <table class="recipient-table">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 35%">Nama</th>
                    <th style="width: 25%">NIP/NIK</th>
                    <th style="width: 35%">Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kepada as $index => $recipient)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $recipient['nama'] }}</td>
                    <td>{{ $recipient['nip_nik'] }}</td>
                    <td>{{ $recipient['jabatan'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</body>
</html>