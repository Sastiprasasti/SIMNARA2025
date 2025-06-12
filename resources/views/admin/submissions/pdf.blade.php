<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $submission->jenis_form == 'form1' ? 'Surat Pengajuan' : ($submission->jenis_form == 'form2' ? 'Permohonan KTP' : 'Form Pengaduan') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 14px;
            margin: 5px 0 0;
        }
        .content {
            margin: 20px 0;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .status {
            text-align: center;
            margin-top: 50px;
            padding: 10px;
            border: 2px solid #000;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">
            @if($submission->jenis_form == 'form1')
                SURAT PENGAJUAN
            @elseif($submission->jenis_form == 'form2')
                FORMULIR PERMOHONAN KTP
            @else
                FORMULIR PENGADUAN
            @endif
        </h1>
        <p class="subtitle">Nomor: {{ sprintf('%04d', $submission->id) }}/{{ strtoupper($submission->jenis_form) }}/{{ date('m/Y') }}</p>
    </div>

    <div class="content">
        <div class="field">
            <span class="label">
                @if($submission->jenis_form == 'form1')
                    Nama Pemohon
                @elseif($submission->jenis_form == 'form2')
                    Nama Pemohon KTP
                @else
                    Nama Pelapor
                @endif
            </span>
            <span>: {{ $submission->nama }}</span>
        </div>

        <div class="field">
            <span class="label">
                @if($submission->jenis_form == 'form1')
                    Alamat KTP
                @elseif($submission->jenis_form == 'form2')
                    Alamat Domisili
                @else
                    Lokasi Kejadian
                @endif
            </span>
            <span>: {{ $submission->alamat }}</span>
        </div>

        <div class="field">
            <span class="label">
                @if($submission->jenis_form == 'form1')
                    Tujuan Pengajuan
                @elseif($submission->jenis_form == 'form2')
                    Alasan Permohonan
                @else
                    Isi Pengaduan
                @endif
            </span>
            <span>: {{ $submission->tujuan }}</span>
        </div>

        <div class="field">
            <span class="label">Tanggal</span>
            <span>: {{ $submission->created_at->format('d F Y') }}</span>
        </div>
    </div>

    <div class="status">
        Status: {{ strtoupper($submission->status) }}
    </div>

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh sistem pada {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>