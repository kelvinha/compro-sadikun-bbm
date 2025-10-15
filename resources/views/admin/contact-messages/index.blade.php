@extends('admin.layout.master')

@section('title', 'Contact Messages')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Contact Messages</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-info" role="alert">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Contact Messages</strong> are messages sent by visitors through the contact form
                                on your website.
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone ?? '-' }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>
                                        @if ($message->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @elseif ($message->status == 'read')
                                        <span class="badge bg-info">Read</span>
                                        @else
                                        <span class="badge bg-success">Replied</span>
                                        @endif
                                    </td>
                                    <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                                class="btn btn-action-info" data-bs-toggle="tooltip" title="View">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-action-danger"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No messages found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection