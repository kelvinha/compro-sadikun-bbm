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
                            User Detail
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">User Detail</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $user->name }} </td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td> {{ $user->email }} </td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{ $user->role ? $user->role->display_name : 'No Role Assigned' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm"><i class="ti ti-arrow-left"
                                    aria-hidden="true"></i> Back</a>
                            <a href="{{ route('admin.users.change-password', $user->id) }}" class="btn btn-primary btn-sm"><i
                                    class="ti ti-lock" aria-hidden="true"></i> Change Password</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i
                                    class="ti ti-pencil" aria-hidden="true"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function confirmDelete(itemId) {
            // Use browser's built-in confirm dialog
            var result = confirm("Are you sure you want to delete this record?");
            if (result) {
                // If user confirms, submit the form
                var form = document.getElementById('deleteForm' + itemId); // Find the corresponding form by ID
                if (form) {
                    form.submit(); // Submit the form
                }
            }
        }
    </script>
@stop
