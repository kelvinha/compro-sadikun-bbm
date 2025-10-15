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
                            User
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">User</h2>
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
                    <div class="text-end p-4 pb-sm-2">
                        <a href="{{ route('admin.users.create') }}"
                            class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
                            <i class="ti ti-plus f-18"></i>
                            Add New
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $item->avatar_url }}" alt="{{ $item->name }}"
                                                        class="rounded-circle" width="32" height="32">
                                                </div>
                                                <div class="ms-2">{{ $item->name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if ($item->role)
                                                <span class="badge bg-primary">{{ $item->role->display_name }}</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary">{{ $item->attributes['role'] ?? 'No Role' }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons d-flex gap-2">
                                                <a href="{{ route('admin.users.show', $item->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="View">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['admin.users.destroy', $item->id],
                                                    'style' => 'display:none',
                                                    'id' => 'deleteForm' . $item->id,
                                                ]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
