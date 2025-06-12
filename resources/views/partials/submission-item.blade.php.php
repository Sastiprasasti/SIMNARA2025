<div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
    <!-- Status Badge and Actions -->
    <div class="d-flex justify-content-between align-items-start mb-3">
        <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
            {{ ucfirst($submission->status) }}
        </span>
        <div class="d-flex align-items-center">
            <small class="text-muted me-3">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ $submission->created_at->format('d M Y') }}
            </small>
        </div>
    </div>
    <!-- Content -->
    <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
    <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
    <!-- Action -->
    @if($submission->status == 'approved' && $submission->admin_document_path)
        <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
           class="btn btn-primary btn-sm rounded-pill w-100"
           target="_blank">
            <i class="fas fa-download me-1"></i>Download Surat Balasan
        </a>
    @else
        <button class="btn btn-secondary btn-sm rounded-pill w-100"
                data-bs-toggle="modal" 
                data-bs-target="#detail-{{ $submission->id }}">
            <i class="fas fa-eye me-1"></i>Detail
        </button>
    @endif
</div>