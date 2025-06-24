@extends('admin.layout.master')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Edit Media</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.media.index') }}" class="btn btn-outline-primary">
                            <i class="ti ti-arrow-left me-1"></i> Back to Media Library
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <!-- Preview Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Media Preview</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        @if($media->is_image)
                                        <img src="{{ asset('storage/' . $media->path) }}" alt="{{ $media->name }}"
                                            class="img-fluid rounded shadow-sm" style="max-height: 300px; width: auto;">
                                        @elseif($media->is_video)
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <i class="ti ti-video fs-1 text-primary"></i>
                                        </div>
                                        @elseif($media->is_document)
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <i class="ti ti-file-text fs-1 text-primary"></i>
                                        </div>
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <i class="ti ti-file fs-1 text-primary"></i>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th class="text-muted" style="width: 100px;">Type</th>
                                                    <td class="text-break">{{ $media->mime_type }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Size</th>
                                                    <td>{{ $media->human_size }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Dimensions</th>
                                                    <td>
                                                        @if($media->is_image && $media->width && $media->height)
                                                        {{ $media->width }}x{{ $media->height }}px
                                                        @else
                                                        -
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Uploaded</th>
                                                    <td>{{ $media->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <!-- Details Card -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Media Details</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.media.update', $media) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label fw-bold">Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $media->name) }}" required
                                                placeholder="Enter media name">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="alt_text" class="form-label fw-bold">Alt Text</label>
                                            <input type="text"
                                                class="form-control @error('alt_text') is-invalid @enderror"
                                                id="alt_text" name="alt_text"
                                                value="{{ old('alt_text', $media->alt_text) }}"
                                                placeholder="Describe the media for accessibility">
                                            <div class="form-text text-muted">Helps improve accessibility and SEO.
                                                Describe the media content briefly.</div>
                                            @error('alt_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="caption" class="form-label fw-bold">Caption</label>
                                            <textarea class="form-control @error('caption') is-invalid @enderror"
                                                id="caption" name="caption" rows="3"
                                                placeholder="Add a caption to display with the media">{{ old('caption', $media->caption) }}</textarea>
                                            <div class="form-text text-muted">Optional: Add a caption that will be
                                                displayed with the media.</div>
                                            @error('caption')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="category" class="form-label fw-bold">Category</label>
                                            <select class="form-control @error('category') is-invalid @enderror"
                                                id="category" name="category">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $key => $value)
                                                <option value="{{ $key }}" {{ old('category', $media->category) == $key
                                                    ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-text text-muted">Organize media by page section.</div>
                                            @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="form-label fw-bold">File URL</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light"
                                                    value="{{ asset('storage/' . $media->path) }}" id="file-url"
                                                    readonly>
                                                <button class="btn btn-outline-primary" type="button"
                                                    onclick="copyToClipboard('file-url')" data-bs-toggle="tooltip"
                                                    title="Copy URL">
                                                    <i class="ti ti-copy"></i>
                                                </button>
                                            </div>
                                            <div class="form-text text-muted">Use this URL to reference the media file.
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ti ti-device-floppy me-1"></i> Update Media
                                                </button>
                                                <a href="{{ route('admin.media.index') }}"
                                                    class="btn btn-light ms-2">Cancel</a>
                                            </div>

                                            <form action="{{ route('admin.media.destroy', $media) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this media? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="ti ti-trash me-1"></i> Delete Media
                                                </button>
                                            </form>
                                        </div>
                                    </form>
                                </div>
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
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Copy to clipboard function
        window.copyToClipboard = function(elementId) {
            const element = document.getElementById(elementId);
            element.select();
            document.execCommand('copy');
            
            // Show success toast
            toastr.success('URL has been copied to clipboard');
            
            // Update tooltip text temporarily
            const button = document.querySelector(`[onclick="copyToClipboard('${elementId}')"]`);
            const tooltip = bootstrap.Tooltip.getInstance(button);
            const originalTitle = button.getAttribute('data-bs-original-title');
            
            button.setAttribute('data-bs-original-title', 'Copied!');
            tooltip.show();
            
            setTimeout(() => {
                button.setAttribute('data-bs-original-title', originalTitle);
                tooltip.hide();
            }, 1000);
        }
    });
</script>
@endsection