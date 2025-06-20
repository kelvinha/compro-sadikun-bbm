@extends('admin.layout.master')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create New Banner</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back to Banners</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($isMultilingual)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="title_id">Title (Indonesian)</label>
                                    <input type="text" class="form-control @error('title_id') is-invalid @enderror"
                                        id="title_id" name="title_id" value="{{ old('title_id') }}">
                                    @error('title_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                                    @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($isMultilingual)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="subtitle_id">Subtitle (Indonesian)</label>
                                    <input type="text" class="form-control @error('subtitle_id') is-invalid @enderror"
                                        id="subtitle_id" name="subtitle_id" value="{{ old('subtitle_id') }}">
                                    @error('subtitle_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($isMultilingual)
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="description_id">Description (Indonesian)</label>
                                    <textarea class="form-control @error('description_id') is-invalid @enderror"
                                        id="description_id" name="description_id"
                                        rows="3">{{ old('description_id') }}</textarea>
                                    @error('description_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Banner Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    <small class="form-text text-muted">Recommended size: 1920x600px</small>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="mobile_image">Mobile Image</label>
                                    <input type="file" class="form-control @error('mobile_image') is-invalid @enderror"
                                        id="mobile_image" name="mobile_image" accept="image/*">
                                    <small class="form-text text-muted">Recommended size: 768x400px</small>
                                    @error('mobile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_text">Button Text</label>
                                    <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                        id="button_text" name="button_text" value="{{ old('button_text') }}">
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            @if($isMultilingual)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_text_id">Button Text (Indonesian)</label>
                                    <input type="text"
                                        class="form-control @error('button_text_id') is-invalid @enderror"
                                        id="button_text_id" name="button_text_id" value="{{ old('button_text_id') }}">
                                    @error('button_text_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_url">Button URL</label>
                                    <input type="text" class="form-control @error('button_url') is-invalid @enderror"
                                        id="button_url" name="button_url" value="{{ old('button_url') }}">
                                    @error('button_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="button_target">Button Target</label>
                                    <select class="form-control @error('button_target') is-invalid @enderror"
                                        id="button_target" name="button_target">
                                        @foreach($targets as $value => $label)
                                        <option value="{{ $value }}" {{ old('button_target', '_self' )==$value
                                            ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('button_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="type">Banner Type</label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type"
                                        name="type" required>
                                        @foreach($types as $value => $label)
                                        <option value="{{ $value }}" {{ old('type', 'homepage' )==$value ? 'selected'
                                            : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                                        id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                    @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="active" name="active" {{
                                        old('active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Create Banner</button>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitButton = document.querySelector('button[type="submit"]');

    if (form && submitButton) {
        form.addEventListener('submit', function(e) {
            console.log('Form submission started');
            submitButton.disabled = true;
            submitButton.textContent = 'Creating...';
        });

        console.log('Banner form loaded successfully');
    } else {
        console.error('Form or submit button not found');
    }
});
</script>
@endsection