@extends('admin.layout.master')

@section('title', 'View Contact Message')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">View Contact Message</h4>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <p class="form-control-static">{{ $message->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <p class="form-control-static">{{ $message->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <p class="form-control-static">{{ $message->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <p class="form-control-static">{{ $message->subject }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <p class="form-control-static">{{ $message->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <p class="form-control-static">
                                    @if ($message->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($message->status == 'read')
                                        <span class="badge bg-info">Read</span>
                                    @else
                                        <span class="badge bg-success">Replied</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <div class="p-3 bg-light rounded">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.contact-messages.mark-as-replied', $message->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Mark as Replied
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection