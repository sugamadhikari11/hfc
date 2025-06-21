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
                                    <h2><i class="bi bi-plus-circle"></i> Add Project
                                        <a href="{{route('manage-projects.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show projects</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-projects.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2 form-group">
                                        <label for="title">Title:
                                            <a style="color: red;">{{$errors->first('title')}}</a>
                                        </label>
                                        <input type="text" id="title" name="title"
                                               class="form-control"
                                               value="{{old('title')}}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2 form-group">
                                                <label for="url">Url:
                                                    <a style="color: red;">{{$errors->first('url')}}</a>
                                                </label>
                                                <input type="text" id="url" name="url"
                                                      class="form-control"
                                                      value="{{old('url')}}">
                                            </div>
                                        </div>
                                    
                                    </div>                                

                                    <div class="row">
                                    
                                        <div class="col-md-12">
                                            <div class="mb-2 form-group">
                                                <label for="image">Image:
                                                    <a style="color: red;">{{$errors->first('image')}}</a>
                                                </label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2 form-group">
                                        <label for="description">Description:
                                            <a style="color: red;">{{$errors->first('description')}}</a>
                                        </label>
                                        <textarea name="description"
                                                  id="description"
                                                  class="form-control">{{old('description')}}</textarea>
                                    </div>

                                    <div class="mt-3 col-md-12">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-plus-circle"></i> Add Activity
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