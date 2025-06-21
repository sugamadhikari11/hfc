{{-- filepath: resources/views/backend/pages/contact/view.blade.php --}}
@extends('backend.master.main')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>View Contact</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact Messages</a></li>
                <li class="breadcrumb-item active">View Contact</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Contact Details</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                                <form action="{{ route('admin.contact.toggle-read', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn {{ $contact->is_read ? 'btn-outline-primary' : 'btn-primary' }}">
                                        <i class="bi {{ $contact->is_read ? 'bi-envelope-open' : 'bi-envelope' }}"></i>
                                        {{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.contact.delete', $contact->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Full Name:</label>
                                    <p>{{ $contact->full_name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Email:</label>
                                    <p>{{ $contact->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Phone Number:</label>
                                    <p>{{ $contact->phone_number ?: 'Not provided' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Date:</label>
                                    <p>{{ $contact->created_at->format('F d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Subject:</label>
                            <p>{{ $contact->subject }}</p>
                        </div>

                        <div>
                            <label class="fw-bold">Message:</label>
                            <div class="message-content p-3 border rounded bg-light">
                                {{ $contact->message }}
                            </div>
                        </div>

                        <div class="mt-4 border-top pt-3">
                            <h6 class="fw-bold">Actions</h6>
                            <div class="d-flex gap-2">
                                <a href="mailto:{{ $contact->email }}" class="btn btn-primary">
                                    <i class="bi bi-reply-fill"></i> Reply by Email
                                </a>
                                @if($contact->phone_number)
                                    <a href="tel:{{ $contact->phone_number }}" class="btn btn-info">
                                        <i class="bi bi-telephone-fill"></i> Call
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Confirm delete
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this contact message?')) {
                this.submit();
            }
        });
    });
</script>
@endsection