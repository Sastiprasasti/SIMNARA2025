<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Disposisi Surat</title>
</head>
<body>
    <h2>Disposisi Surat Masuk</h2>
    <p>Yth. {{ $penerima }}</p>
    <p>Anda menerima disposisi surat dari sistem. Silakan cek detail surat melalui sistem manajemen surat masuk.</p>

    <p><strong>Nomor Surat:</strong> {{ $nomorSurat }}</p>
    <p><strong>Dari:</strong> {{ $pengirim }}</p>
    <p><strong>Perihal:</strong> {{ $perihal }}</p>

    <p>Terima kasih.</p>
</body>
</html>
