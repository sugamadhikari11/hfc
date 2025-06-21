@extends('backend.master.main')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="py-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-pencil-square"></i> Update Activity
                                        <a href="{{route('manage-projects.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show projects</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <form action="{{ route('manage-projects.update', $activity->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-2 form-group">
                                        <label for="title">Title:
                                            <a style="color: red;">{{ $errors->first('title') }}</a>
                                        </label>
                                        <input type="text" id="title" name="title" class="form-control"
                                               value="{{ old('title', $activity->title) }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2 form-group">
                                                <label for="url">Url:
                                                    <a style="color: red;">{{ $errors->first('url') }}</a>
                                                </label>
                                                <input type="text" id="url" name="url" class="form-control"
                                                       value="{{ old('url', $activity->url) }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Show and change image --}}
                                    @php
                                        $files = json_decode($activity->files_field, true);
                                        $imagePath = $files['image'] ?? null;
                                    @endphp

                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($imagePath)
                                                <p><strong>Current Image:</strong></p>
                                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Project Image" style="max-width: 150px;">
                                            @endif
                                            <div class="mb-2 form-group mt-2">
                                                <label for="image">Change Image:</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                                <a style="color: red;">{{ $errors->first('image') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 form-group">
                                        <label for="description">Description:
                                            <a style="color: red;">{{ $errors->first('description') }}</a>
                                        </label>
                                        <textarea name="description" id="description" class="form-control">
                                            {{ old('description', $activity->description) }}
                                        </textarea>
                                    </div>

                                    <div class="mt-3 col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-pencil-square"></i> Update Activity
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
        });
    </script>
@endsection
