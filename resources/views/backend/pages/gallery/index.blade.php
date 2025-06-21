@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card py-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><i class="bi bi-plus-circle"></i> Add Gallery</h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-gallery.store')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-2">
                                        <label for="title">Title:
                                            <a style="color: red;">{{$errors->first('title')}}</a>
                                        </label>
                                        <input type="text" id="title" name="title"
                                               class="form-control"
                                               value="{{old('title')}}">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="image">Image:
                                            <a style="color: red;">{{$errors->first('image')}}</a>
                                        </label>
                                        <input type="file" name="images[]" multiple class="form-control">
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <button class="btn btn-success w-100">Add Images</button>
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
