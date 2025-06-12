@extends('layouts.app')  
@section('content') 
<div class="container">     
    <div class="row justify-content-center">         
        <div class="col-md-8">             
            <div class="card shadow-sm">                 
                <div class="card-header bg-success text-white">                     
                    <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Form SPPD</h5>                 
                </div>                 
                <div class="card-body">                     
                    <form method="POST" action="{{ route('submissions.store') }}" enctype="multipart/form-data">                         
                        @csrf                         
                        <input type="hidden" name="jenis_form" value="form2">                          
                        
                        <div class="mb-3">                             
                            <label class="form-label">Nama Pemohon</label>                             
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required>                             
                            @error('nama')                                 
                                <div class="invalid-feedback">{{ $message }}</div>                             
                            @enderror                         
                        </div>                          
                        
                        <div class="mb-3">                             
                            <label class="form-label">Alamat Domisili</label>                             
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required></textarea>                             
                            @error('alamat')                                 
                                <div class="invalid-feedback">{{ $message }}</div>                             
                            @enderror                         
                        </div>                          
                        
                        <div class="mb-3">                             
                            <label class="form-label">Alasan Permohonan</label>                             
                            <textarea name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" rows="3" required></textarea>                             
                            @error('tujuan')                                 
                                <div class="invalid-feedback">{{ $message }}</div>                             
                            @enderror                         
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Dokumen Pendukung (PDF)</label>
                            <input type="file" name="document" class="form-control @error('document') is-invalid @enderror" accept=".pdf" required>
                            @error('document')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maks. ukuran file: 2MB</small>
                        </div>
                        
                        <div class="d-flex justify-content-between">                             
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">                                 
                                <i class="fas fa-arrow-left me-1"></i>Kembali                             
                            </a>                             
                            <button type="submit" class="btn btn-success">                                 
                                <i class="fas fa-paper-plane me-1"></i>Kirim Permohonan                             
                            </button>                         
                        </div>                     
                    </form>                 
                </div>             
            </div>         
        </div>     
    </div> 
</div> 
@endsection