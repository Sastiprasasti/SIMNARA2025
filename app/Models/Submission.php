<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model 
{
    protected $fillable = [
        'user_id',
        'nama', 
        'alamat',
        'menimbang',
        'tujuan',
        'jenis_form',
        'kepada',
        'untuk',
        'jangka_waktu',
        'status',
        'document_path',
        'admin_remarks',
        'admin_document_path'
    ];
    
    protected $casts = [
        'kepada' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}