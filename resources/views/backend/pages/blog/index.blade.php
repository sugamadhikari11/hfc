@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-newspaper"></i> Blogs List
                                <a href="{{route('manage-blog.create')}}"
                                   class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Blog</a>
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
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($postsData->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                We could not find any data
                                                <br>
                                                <a href="{{route('manage-blog.index')}}">Refresh
                                                    page</a>

                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($postsData as $blog)
                                        <tr>
                                            <td>
                                                {{$blog->title}}
                                            </td>
                                            <td>
                                                {{$blog->category->name}}
                                            </td>
                                            <td>
                                                @if($blog->files_field)
                                                    <img src="{{url($blog->files_field['thumbnail'])}}"
                                                         alt="image not found" style="width: 80px;">
                                                @else
                                                    <span class="badge bg-danger"> No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($blog->is_published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>


                                            <td style="width: 12%;">
                                                <a href="{{route('manage-blog.show',$blog->id)}}"
                                                   class="btn btn-primary btn-sm" title="Show Blog">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{route('manage-blog.edit',$blog->id)}}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('manage-blog.toggle-publish', $blog->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm {{ $blog->is_published ? 'btn-warning' : 'btn-info' }}"
                                                                title="{{ $blog->is_published ? 'Unpublish' : 'Publish' }}">
                                                            <i class="bi {{ $blog->is_published ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                                        </button>
                                                    </form>

                                            </td>
                                        </tr>

                                        @if($blog->child)
                                            @include('backend.pages.blog.manageChild', ['childDataTable' => $blog->child])

                                        @endif

                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


