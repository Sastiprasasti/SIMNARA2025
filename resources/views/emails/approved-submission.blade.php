@component('mail::message')
# Dokumen Pengajuan Disetujui

Pengajuan Anda telah disetujui. Silahkan temukan dokumen yang terlampir.

@if($message)
Pesan dari admin:
{{ $message }}
@endif

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent