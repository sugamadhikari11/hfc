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
                                    <h2><i class="bi bi-pencil-square"></i> Update Page
                                        <a href="{{route('manage-page.index')}}"
                                           class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-eye-fill"></i> Show Page</a>
                                    </h2>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('manage-page.update',$pageData->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="form-group mb-3">
                                        <label for="parent_id">parent news:
                                            <a style="color: red;">{{$errors->first('parent_id')}}</a>
                                        </label>

                                        <select name="parent_id" class="form-control" id="parent_id">
                                            <option value="">Select a parent of news</option>
                                            @foreach($pageParent as $parent)
                                                <option value="{{$parent->id}}"
                                                        @if( isSet($parentId) &&  $parentId !== "" && $parent->id === $parentId) selected @endif >{{$parent->title}}</option>


                                                @if($parent->child)
                                                    @include('backend.pages.page.create-nested-child-page',['childrenData' => $parent->child])
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="title">Title:
                                            <a style="color: red;">{{$errors->first('title')}}</a>
                                        </label>
                                        <input type="text" id="title" name="title"
                                               class="form-control"
                                               value="{{$pageData->title}}">
                                    </div>
                            </div>

                            <div class="row">

                                <div class="col-md-8">
                                    <div class="form-group mb-2">
                                        <label for="slug">Slug:
                                            <a style="color: red;">{{$errors->first('slug')}}</a>
                                        </label>
                                        <input type="text" id="slug" name="slug"
                                               class="form-control"
                                               value="{{$pageData->slug}}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="summary">Summary:
                                            <a style="color: red;">{{$errors->first('summary')}}</a>
                                        </label>
                                        <textarea name="summary" id="summary"
                                                  class="form-control">{{$pageData->summary}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="sub_title">Sub Title:
                                            <a style="color: red;">{{$errors->first('sub_title')}}</a>
                                        </label>
                                        <input type="text" id="sub_title" name="sub_title"
                                               class="form-control"
                                               value="{{$pageData->sub_title}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="page_section_name"> Page Section Name</label>
                                        <div class="tag-input-container">
                                            <input type="text" class="form-control"
                                                   name="page_section_name"
                                                   value="{{$pageData->page_section_name}}"
                                                   id="page_section_name">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <select name="is_published" id="status" class="form-control">
                                            <option value="0"
                                                    {{$pageData->is_published == 0 ? 'selected' : ''}}>Draft
                                            </option>
                                            <option value="1"
                                                    {{$pageData->is_published == 1 ? 'selected' : ''}}
                                            >published
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <picture>
                                            @if($pageData->files_field)
                                                <img src="{{url($pageData->files_field['thumbnail'])}}"
                                                     alt="image not found" style="width: 80px;">
                                            @else
                                                <span class="badge bg-danger"> No Image</span>
                                            @endif
                                        </picture>
                                        <input type="file" name="image" class="form-control">
                                    </div>


                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description:
                                    <a style="color: red;">{{$errors->first('description')}}</a>
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="form-control">{{$pageData->description}}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_title">Meta Title:</label>
                                <input type="text" id="meta_title" name="meta_title"
                                       class="form-control"
                                       value="{{$pageData->meta_title}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_description">Meta Description:</label>
                                <textarea name="meta_description" id="meta_description"
                                          class="form-control">{{$pageData->meta_description}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="meta_keywords"> Meta Keywords</label>
                                <div class="tag-input-container">
                                    <input type="text" class="form-control"
                                           name="meta_keywords"
                                           value="{{$pageData->meta_keywords}}"
                                           id="meta_keywords">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success w-100">
                                    <i class="bi bi-plus-circle"></i> Update News
                                </button>
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
    @parent
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('summary', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection

