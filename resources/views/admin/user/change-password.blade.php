@extends('admin.layout.master')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Change Password for {{ $user->name }}</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></li>
                    <li class="breadcrumb-item">Change Password</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Change Password</h5>
                <div class="card-header-right">
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary btn-sm">Back to User</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update-password', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        <small class="form-text text-muted">Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
