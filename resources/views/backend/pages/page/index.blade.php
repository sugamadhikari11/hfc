@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card py-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>
                                <i class="bi bi-newspaper"></i> Page List
                                <a href="{{route('manage-page.create')}}"
                                   class="btn btn-primary btn-sm float-end">
                                    <i class="bi bi-plus-circle"></i> Add Page</a>
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
                                    @if($pageData->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                We could not find any data
                                                <br>
                                                <a href="{{route('manage-page.index')}}">Refresh
                                                    page</a>

                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($pageData as $page)
                                        <tr>
                                            <td>
                                                {{$page->title}}
                                            </td>

                                            <td>
                                                @if($page->files_field)
                                                    <img src="{{url($page->files_field['thumbnail'])}}"
                                                         alt="image not found" style="width: 80px;">
                                                @else
                                                    <span class="badge bg-danger"> No Image</span>
                                                @endif
                                            </td>

                                            <td style="width: 20%;">
                                                <a href="{{route('manage-page.show',$page->id)}}"
                                                   class="btn btn-primary btn-sm" title="Show News">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{route('manage-page.edit',$page->id)}}"
                                                   class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <form action="{{route('manage-page.destroy',$page->id)}}" method="post"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure ?')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>

                                        @if($page->child)
                                            @include('backend.pages.page.manageChild', ['childDataTable' => $page->child])
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


