<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulir Permohonan KTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 2cm;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }
        .warning {
            background: #f8f9fa;
            padding: 10px;
            margin-top: 20px;
            font-size: 12px;
        }
        .status-box {
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>FORMULIR PERMOHONAN KTP ELEKTRONIK</h2>
        <p>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</p>
    </div>

    <div class="title">
        No. Register: {{ sprintf('REG-%04d/KTP/%s', $submission->id, date('Y')) }}
    </div>

    <div class="box">
        <div class="field">
            <span class="label">Nama Lengkap</span>
            <span>: {{ $submission->nama }}</span>
        </div>

        <div class="field">
            <span class="label">Alamat Domisili</span>
            <span>: {{ $submission->alamat }}</span>
        </div>

        <div class="field">
            <span class="label">Alasan Permohonan</span>
            <span>: {{ $submission->tujuan }}</span>
        </div>

        <div class="field">
            <span class="label">Tanggal Permohonan</span>
            <span>: {{ $submission->created_at->format('d F Y') }}</span>
        </div>
    </div>

    <div class="warning">
        <strong>Persyaratan yang harus dilengkapi:</strong>
        <ol>
            <li>Fotokopi KK</li>
            <li>Surat Pengantar RT/RW</li>
            <li>Pas Foto 3x4 (2 lembar)</li>
        </ol>
    </div>

    <div class="status-box">
        STATUS PERMOHONAN: {{ strtoupper($submission->status) }}
    </div>
</body>
</html>