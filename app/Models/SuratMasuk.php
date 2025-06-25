<?php

// app/Models/SuratMasuk.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'tanggal',
        'nama_pengirim',
        // 'tujuan',
        'perihal',
        'file_path',
        'disposisi',
        'disposisi_token', // ← HARUS ADA
        'status_disposisi'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];
}
