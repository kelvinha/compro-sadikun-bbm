@extends('admin.layout.master')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Upload Media</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-primary">Back to Media Library</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="file">File <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                        id="file" name="file" required>
                                    <small class="form-text text-muted">Max file size: 10MB</small>
                                    @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    <small class="form-text text-muted">Leave empty to use the original file
                                        name.</small>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="alt_text">Alt Text</label>
                                    <input type="text" class="form-control @error('alt_text') is-invalid @enderror"
                                        id="alt_text" name="alt_text" value="{{ old('alt_text') }}">
                                    <small class="form-text text-muted">Alternative text for accessibility.</small>
                                    @error('alt_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                        id="caption" name="caption" value="{{ old('caption') }}">
                                    @error('caption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control @error('category') is-invalid @enderror" id="category"
                                        name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $key }}" {{ old('category')==$key ? 'selected' : '' }}>{{
                                            $value }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Organize media by page section.</small>
                                    @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Upload Media</button>
                            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="card-title">Bulk Upload</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bulk-dropzone" class="dropzone-container border rounded p-4 text-center"
                                style="min-height: 200px; cursor: pointer;">
                                <div class="dz-message">
                                    <i class="ti ti-upload fs-1 text-primary mb-2"></i>
                                    <h5>Drop files here or click to upload</h5>
                                    <p class="text-muted">Upload multiple files at once (Max 10MB per file)</p>
                                </div>
                                <input type="file" id="bulk-file-input" multiple style="display: none;"
                                    accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                <div id="upload-progress" class="mt-3" style="display: none;">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                    </div>
                                    <div class="text-center mt-2">
                                        <span id="upload-status">Uploading...</span>
                                    </div>
                                </div>
                                <div id="upload-results" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('bulk-dropzone');
    const fileInput = document.getElementById('bulk-file-input');
    const uploadProgress = document.getElementById('upload-progress');
    const progressBar = document.querySelector('.progress-bar');
    const uploadStatus = document.getElementById('upload-status');
    const uploadResults = document.getElementById('upload-results');

    // Click to select files
    dropzone.addEventListener('click', function() {
        fileInput.click();
    });

    // Drag and drop functionality
    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropzone.classList.add('border-primary');
    });

    dropzone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropzone.classList.remove('border-primary');
    });

    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropzone.classList.remove('border-primary');
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // File input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    function handleFiles(files) {
        if (files.length === 0) return;

        const formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }
        formData.append('_token', '{{ csrf_token() }}');

        // Show progress
        uploadProgress.style.display = 'block';
        uploadResults.innerHTML = '';
        progressBar.style.width = '0%';
        uploadStatus.textContent = 'Uploading ' + files.length + ' files...';

        // Upload files
        fetch('{{ route("admin.media.batch-upload") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            progressBar.style.width = '100%';

            if (data.success) {
                uploadStatus.textContent = 'Upload completed successfully!';
                uploadStatus.className = 'text-success';

                // Show results
                let resultsHtml = '<div class="alert alert-success">' + data.message + '</div>';
                if (data.uploaded.length > 0) {
                    resultsHtml += '<div class="row">';
                    data.uploaded.forEach(file => {
                        resultsHtml += `
                            <div class="col-md-3 mb-2">
                                <div class="card">
                                    <div class="card-body text-center p-2">
                                        <small class="text-success">${file.name}</small>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    resultsHtml += '</div>';
                }

                if (data.errors.length > 0) {
                    resultsHtml += '<div class="alert alert-warning mt-2"><strong>Errors:</strong><ul class="mb-0">';
                    data.errors.forEach(error => {
                        resultsHtml += `<li>${error.file}: ${error.error}</li>`;
                    });
                    resultsHtml += '</ul></div>';
                }

                uploadResults.innerHTML = resultsHtml;

                // Reset file input
                fileInput.value = '';

                // Refresh page after 3 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                uploadStatus.textContent = 'Upload failed!';
                uploadStatus.className = 'text-danger';
                uploadResults.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Upload failed') + '</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            uploadStatus.textContent = 'Upload failed!';
            uploadStatus.className = 'text-danger';
            uploadResults.innerHTML = '<div class="alert alert-danger">An error occurred during upload.</div>';
        });
    }
});
</script>
@endsection