@extends('admin.layout.master')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add New User
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Add New User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'admin.users.store', 'class' => 'user-form', 'enctype' => 'multipart/form-data', 'id' => 'userCreateForm']) !!}
                        @include ('admin.user.form', ['formMode' => 'create'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Form validation
    $('#userCreateForm').on('submit', function(e) {
        let isValid = true;

        // Clear previous error states
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Validate name
        const name = $('input[name="name"]').val().trim();
        if (name === '') {
            showFieldError('input[name="name"]', 'Name is required');
            isValid = false;
        }

        // Validate email
        const email = $('input[name="email"]').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            showFieldError('input[name="email"]', 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            showFieldError('input[name="email"]', 'Please enter a valid email address');
            isValid = false;
        }

        // Validate password
        const password = $('input[name="password"]').val();
        if (password === '') {
            showFieldError('input[name="password"]', 'Password is required');
            isValid = false;
        } else if (password.length < 8) {
            showFieldError('input[name="password"]', 'Password must be at least 8 characters');
            isValid = false;
        }

        // Validate role
        const role = $('select[name="role_id"]').val();
        if (role === '' || role === null) {
            showFieldError('select[name="role_id"]', 'Please select a role');
            isValid = false;
        }

        // Validate avatar if selected
        const avatar = $('input[name="avatar"]')[0];
        if (avatar.files.length > 0) {
            const file = avatar.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (file.size > maxSize) {
                showFieldError('input[name="avatar"]', 'File size must be less than 2MB');
                isValid = false;
            }

            if (!allowedTypes.includes(file.type)) {
                showFieldError('input[name="avatar"]', 'Please select a valid image file (JPG, PNG, GIF)');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
            // Show error toastr
            toastr.error('Please fix the errors in the form before submitting.', 'Validation Error');
        }
    });

    function showFieldError(fieldSelector, message) {
        const field = $(fieldSelector);
        field.addClass('is-invalid');
        field.after('<div class="invalid-feedback d-block">' + message + '</div>');
    }

    // Real-time validation
    $('input[name="email"]').on('blur', function() {
        const email = $(this).val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email !== '' && !emailRegex.test(email)) {
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').remove();
            $(this).after('<div class="invalid-feedback d-block">Please enter a valid email address</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').remove();
        }
    });

    $('input[name="password"]').on('input', function() {
        const password = $(this).val();
        const strengthIndicator = $(this).siblings('.password-strength');

        if (password.length > 0) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            let strengthText = '';
            let strengthClass = '';

            if (strength < 2) {
                strengthText = 'Weak';
                strengthClass = 'text-danger';
            } else if (strength < 4) {
                strengthText = 'Medium';
                strengthClass = 'text-warning';
            } else {
                strengthText = 'Strong';
                strengthClass = 'text-success';
            }

            if (strengthIndicator.length === 0) {
                $(this).after('<small class="password-strength form-text ' + strengthClass + '">Password strength: ' + strengthText + '</small>');
            } else {
                strengthIndicator.attr('class', 'password-strength form-text ' + strengthClass).text('Password strength: ' + strengthText);
            }
        } else {
            strengthIndicator.remove();
        }
    });
});
</script>
@endpush
