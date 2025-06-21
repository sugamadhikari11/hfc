@extends('backend.master.main')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Contact Messages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Contact Messages</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title">All Contact Messages</h5>
                            
                     
                        </div>

                        <form id="batch-form" action="" method="POST">
                            @csrf
                        
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="select-all">
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contactData as $contact)
                                            <tr class="{{ $contact->is_read ? '' : 'fw-bold' }}">
                                                <td>
                                                    <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" class="contact-checkbox">
                                                </td>
                                                <td>{{ $contact->full_name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ Str::limit($contact->subject, 40) }}</td>
                                                <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if($contact->is_read)
                                                        <span class="badge bg-success">Read</span>
                                                    @else
                                                        <span class="badge bg-warning">Unread</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="gap-2 d-flex">
                                                    
                                                        
                                                        {{-- <form action="{{ route('contact-toggle-read', $contact->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm {{ $contact->is_read ? 'btn-secondary' : 'btn-primary' }}">
                                                                <i class="bi {{ $contact->is_read ? 'bi-envelope-open' : 'bi-envelope' }}"></i>
                                                            </button>
                                                        </form> --}}
                                                
                                                        <form action="{{ route('contact-delete', $contact->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No contact messages found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                           
                        </form>
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
        // Handle select all checkbox
        $('#select-all').on('change', function() {
            $('.contact-checkbox').prop('checked', $(this).prop('checked'));
            updateDeleteButtonState();
        });
        
        // Handle individual checkboxes
        $('.contact-checkbox').on('change', function() {
            updateDeleteButtonState();
        });
        
        // Update delete button state
        function updateDeleteButtonState() {
            const checkedCount = $('.contact-checkbox:checked').length;
            $('#batch-delete-btn').prop('disabled', checkedCount === 0);
        }
        
        // Confirm delete for single items
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this contact message?')) {
                this.submit();
            }
        });
        
        // Confirm delete for batch
        $('#batch-form').on('submit', function(e) {
            e.preventDefault();
            const checkedCount = $('.contact-checkbox:checked').length;
            if (checkedCount > 0 && confirm(`Are you sure you want to delete ${checkedCount} selected contact messages?`)) {
                this.submit();
            }
        });
    });
</script>
@endsection