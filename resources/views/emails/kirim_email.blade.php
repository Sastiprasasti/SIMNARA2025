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

    <p>Klik tombol berikut untuk menyetujui disposisi:</p>


    <a href="{{ url('/approve-disposisi/' . $token) }}" 
       style="background:#28a745; padding:10px 15px; color:white; text-decoration:none;">
        Setujui Disposisi
    </a>
    
    <a href="{{ url('/reject-disposisi/' . $token) }}" style="background:#dc3545; padding:10px 15px; color:white; text-decoration:none;">
        Tolak Disposisi
    </a>
    

    <p>Terima kasih... lop youuu</p>
</body>
</html>
