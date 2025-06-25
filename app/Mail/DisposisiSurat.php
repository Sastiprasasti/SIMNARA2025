<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisposisiSurat extends Mailable
{
    use Queueable, SerializesModels;

    public $penerima;
    public $nomorSurat;
    public $pengirim;
    public $perihal;
    public $token;

    public function __construct($penerima, $nomorSurat, $pengirim, $perihal, $token)
    {
        $this->penerima = $penerima;
        $this->nomorSurat = $nomorSurat;
        $this->pengirim = $pengirim;
        $this->perihal = $perihal;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Disposisi Surat')
            ->view('emails.kirim_email'); // Pastikan ini file blade kamu
    }
}
