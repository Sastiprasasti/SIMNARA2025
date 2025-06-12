@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Back to Dashboard Button -->
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary border-2 rounded-pill hover-lift px-4 py-2 transition-all">
            <i class="fas fa-arrow-left me-2 text-primary"></i>
            <span class="d-inline-block position-relative">
                Back to Dashboard
                <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-primary opacity-75 transition-all"></div>
            </span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="card shadow-lg rounded-4 border-0 transform-hover transition-all">
        <!-- Enhanced Header -->
        <div class="card-header bg-gradient-primary text-blue d-flex align-items-center justify-content-between py-4 px-4 rounded-top-4 position-relative overflow-hidden">
            <!-- Decorative Background -->
            
            <div class="d-flex align-items-center">
                <div class="bg-blue bg-opacity-20 p-2 rounded-circle me-3">
                    <i class="fas fa-history fa-lg text-warning"></i>
                </div>
                <h4 class="mb-0 fw-bold">Submission History</h4>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="badge bg-warning text-dark me-3 px-3 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-list-alt me-2"></i>
                    {{ $submissions->count() }} Entries
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                    <i class="fas fa-clipboard-list fa-lg text-success"></i>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-3">
                <table class="table table-hover align-middle custom-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center ps-4 py-3">#</th>
                            <th class="py-3"><i class="fas fa-calendar me-2 text-primary"></i>Date</th>
                            <th class="py-3"><i class="fas fa-user me-2 text-success"></i>User</th>
                            <th class="py-3"><i class="fas fa-tag me-2 text-info"></i>Form Type</th>
                            <th class="py-3"><i class="fas fa-file-signature me-2 text-warning"></i>Submission</th>
                            <th class="py-3"><i class="fas fa-tasks me-2 text-danger"></i>Status</th>
                            <th class="py-3 text-center"><i class="fas fa-file-alt me-2 text-secondary"></i>Document</th>
                            <th class="text-center pe-4"><i class="fas fa-cogs me-2 text-dark"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr class="border-bottom transition-all hover-bg-light">
                                <td class="text-center fw-bold text-primary ps-4">{{ $loop->iteration }}</td>
                                <td class="text-muted">{{ $submission->created_at->format('d M Y, H:i') }}</td>
                                <td class="d-flex align-items-center">
                                    <div class="avatar-sm bg-success text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <span class="text-dark">{{ $submission->user->name }}</span>
                                </td>
                                <td>
                                    @switch($submission->jenis_form)
                                        @case('form1')
                                            <span class="badge bg-info text-white px-3 py-2 rounded-pill">surat tugas</span>
                                            @break
                                        @case('form2')
                                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">sppd</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">kuitansi</span>
                                    @endswitch
                                </td>
                                <td class="text-truncate text-muted" style="max-width: 200px;">{{ $submission->nama }}</td>
                                <!-- Inside the status form in the table -->
<td>
    <form action="{{ route('admin.submissions.status', $submission) }}" 
        method="POST" 
        class="status-form"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="d-flex flex-column gap-2">
            <select name="status" class="form-select form-select-sm border-0 shadow-sm transition-all text-white 
                @if($submission->status == 'pending') bg-warning 
                @elseif($submission->status == 'approved') bg-success 
                @else bg-danger @endif" 
                data-previous-value="{{ $submission->status }}">
                @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                    <option value="{{ $value }}" {{ $submission->status == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <!-- Add remarks textarea -->
            <textarea name="admin_remarks" 
                     class="form-control form-control-sm" 
                     placeholder="Add remarks for user..."
                     rows="2">{{ $submission->admin_remarks }}</textarea>

            <input type="file" name="admin_document" 
                class="form-control form-control-sm transition-all border-primary" 
                accept=".pdf">
                
            <button type="submit" class="btn btn-sm btn-primary mt-1 transition-all">
                <i class="fas fa-paper-plane me-1"></i> Update & Send
            </button>
        </div>
    </form>
</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2">
                                        @if($submission->document_path)
                                            <a href="{{ Storage::url('documents/'.$submission->document_path) }}"
                                            class="btn btn-sm btn-outline-info rounded-pill transition-all"
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>User PDF
                                            </a>
                                        @endif
                                        @if($submission->admin_document_path)
                                            <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill transition-all"
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>Admin PDF
                                            </a>
                                        @endif
                                        @if($submission->jenis_form == 'form1')
                                            <a href="{{ route('admin.submissions.view', $submission) }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill transition-all" 
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>Form Details
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary transition-all" data-bs-toggle="modal" 
                                                data-bs-target="#detail-{{ $submission->id }}">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        @if($submission->document_path || $submission->jenis_form == 'form1')
                                            <a href="{{ $submission->jenis_form == 'form1' ? route('admin.submissions.pdf', $submission) : route('admin.submissions.download', $submission) }}" 
                                            class="btn btn-sm btn-outline-success transition-all">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Submission Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4 text-primary">Applicant Name</dt>
                    <dd class="col-sm-8 text-dark">{{ $submission->nama }}</dd>

                    <dt class="col-sm-4 text-primary">Submission Date</dt>
                    <dd class="col-sm-8 text-muted">{{ $submission->created_at->format('d M Y, H:i') }}</dd>

                    <dt class="col-sm-4 text-primary">Status</dt>
                    <dd class="col-sm-8">
                        @php
                            $statusClass = match($submission->status) {
                                'approved' => 'success',
                                'pending' => 'warning',
                                default => 'danger'
                            };
                        @endphp
                        <span class="badge bg-{{ $statusClass }} text-white px-3 py-2">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </dd>

                    @if($submission->admin_remarks)
                    <dt class="col-sm-4 text-primary">Admin Remarks</dt>
                    <dd class="col-sm-8">
                        <div class="alert alert-info py-2 px-3 mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $submission->admin_remarks }}
                        </div>
                    </dd>
                    @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-inbox fa-3x text-primary opacity-50"></i>
                                        </div>
                                        <h5 class="text-muted">No Submissions Found</h5>
                                        <p class="text-muted small">Start by creating a new submission</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
/* Global Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

.form-control:focus {
    border-color: #2575fc;
    box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
}

textarea.form-control-sm {
    font-size: 0.875rem;
    min-height: 60px;
}

.alert-info {
    background-color: rgba(37, 117, 252, 0.1);
    border: 1px solid rgba(37, 117, 252, 0.2);
    border-radius: 8px;
    color: #0056b3;
}   

/* Container */
.container-fluid {
    max-width: 1400px;
    margin: auto;
    padding: 20px;
}

/* Back to Dashboard Button */
.btn-outline-primary {
    border: 2px solid #007bff;
    color: #007bff;
    border-radius: 30px;
    transition: all 0.3s;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
}

/* Card Styles */
.card {
    background-color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    border: none;
    transition: all 0.3s;
}

.card:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #2575fc, #2575fc);
    color: white;
    padding: 20px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.card-body {
    padding: 30px;
}

/* Table Styles */
.table-hover {
    border-radius: 10px;
}

.table thead {
    background-color: #f9f9f9;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
}

.table td {
    vertical-align: middle;
}

.table tr:hover {
    background-color: #2575fc;
}

.table td i {
    font-size: 1.1rem;
}

/* Status Badge */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
}

/* Form Styles */
.form-select, .form-control {
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.form-control-sm {
    padding: 8px;
}

button[type="submit"] {
    background-color: #007bff;
    border-radius: 25px;
    padding: 8px 16px;
    color: white;
    font-weight: bold;
    border: none;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Modal Styles */
.modal-content {
    border-radius: 15px;
}

.modal-header {
    background-color: #007bff;
    color: white;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

/* Avatar */
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 1.5rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px 0;
}

.empty-state-icon {
    background-color: #e9ecef;
}

.empty-state h5 {
    font-weight: bold;
    color: #6c757d;
}

.empty-state p {
    color: #6c757d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-body {
        padding: 15px;
    }

    .table td, .table th {
        padding: 8px;
    }

    .avatar-sm {
        width: 35px;
        height: 35px;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-form').forEach(form => {
        const select = form.querySelector('select');
        const fileInput = form.querySelector('input[type="file"]');
        const remarkInput = form.querySelector('textarea[name="admin_remarks"]');
        const submitButton = form.querySelector('button[type="submit"]');
        
        // Initially hide submit button
        if (submitButton) {
            submitButton.style.display = 'none';
        }

        // Show submit button if there are any changes
        const showSubmitIfChanged = () => {
            if (submitButton) {
                const hasFileChange = fileInput && fileInput.files.length > 0;
                const hasRemarkChange = remarkInput && remarkInput.value.trim() !== remarkInput.defaultValue;
                const hasStatusChange = select && select.value !== select.dataset.previousValue;
                
                submitButton.style.display = (hasFileChange || hasRemarkChange || hasStatusChange) ? 'block' : 'none';
            }
        };

        // Add event listeners
        if (fileInput) {
            fileInput.addEventListener('change', showSubmitIfChanged);
        }
        if (remarkInput) {
            remarkInput.addEventListener('input', showSubmitIfChanged);
        }
        if (select) {
            select.addEventListener('change', showSubmitIfChanged);
        }

        // Store initial values
        if (select) select.dataset.previousValue = select.value;
        if (remarkInput) remarkInput.defaultValue = remarkInput.value;
    });
});
</script>
@endsection