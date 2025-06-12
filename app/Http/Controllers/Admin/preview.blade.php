@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Preview PDF</h3>
            
            <div class="d-flex gap-2">
                @if($submission->status === 'pending')
                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check me-1"></i>Setujui
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-times me-1"></i>Tolak
                        </button>
                    </form>
                @elseif($submission->status === 'approved')
                    <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-download me-1"></i>Download PDF
                    </a>
                @endif
            </div>
        </div>
        
        <div class="card-body p-0">
            @include($pdfView, ['submission' => $submission])
        </div>
    </div>
</div>
@endsection