@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-4x text-success mb-3"></i>
                        <h2 class="card-title">Registrasi</h2>
                        <p class="text-muted">Buat akun baru</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Nama Lengkap" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="Email" 
                                    value="{{ old('email') }}" 
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Password" 
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password_confirmation" 
                                    class="form-control" 
                                    placeholder="Konfirmasi Password" 
                                    required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Daftar
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="text-muted">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-success">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection