<!-- resources/views/errors/404.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>404</h1>
        <p>Halaman yang Anda cari tidak ditemukan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection
