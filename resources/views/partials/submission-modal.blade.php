<div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <dl class="row g-3 mb-0">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                            {{ ucfirst($submission->status) }}
                        </span>
                        @if($submission->admin_remarks)
                            <div class="alert alert-light border mt-2 p-2 mb-0">
                                <small class="d-block fw-bold text-muted mb-1">Keterangan Admin:</small>
                                <p class="small mb-0">{{ $submission->admin_remarks }}</p>
                            </div>
                        @endif
                    </dd>
                    <!-- Rest of the modal content... -->
                </dl>
            </div>
        </div>
    </div>
</div>