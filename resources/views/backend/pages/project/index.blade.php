@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="py-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-calendar-event"></i> projects List
                                <a href="{{ route('manage-projects.create') }}"
                                   class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add project
                                </a>
                            </h2>
                        </div>

                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($projects->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                We could not find any data
                                                <br>
                                                <a href="{{ route('manage-projects.index') }}">Refresh page</a>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($projects as $activity)
                                        <tr>
                                            <td>{{ $activity->title }}</td>
                                            <td>
                                                @php
                                                    $imagePath = null;
                                                    if (!empty($activity->files_field)) {
                                                        $files = json_decode($activity->files_field, true);
                                                        $imagePath = $files['image'] ?? null;
                                                    }
                                                @endphp
                                                

                                                @if($imagePath)
                                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Project Image" style="width: 100px;">
                                                @else
                                                    <span class="badge bg-danger">No Image</span>
                                                @endif
                                            </td>

                                            <td style="width: 20%;">
                                                <a href="{{ route('manage-projects.show', $activity->id) }}"
                                                   class="btn btn-primary btn-sm" title="Show Activity">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('manage-projects.edit', $activity->id) }}"
                                                   class="btn btn-success btn-sm" title="Edit Activity">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{ route('manage-projects.destroy', $activity->id) }}" method="post" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure ?')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
