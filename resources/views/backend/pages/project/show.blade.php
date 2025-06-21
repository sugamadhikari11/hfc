@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
            <div class="card">
                <div class="card-body">
                    <div class="mt-3 mb-3 row">
                        <div class="col-md-10">
                            <h3><i class="bi bi-calendar-event"></i> {{$activity->title}}
                           </h3>
                         
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('manage-projects.index')}}"
                               class="btn btn-primary pull-right">
                                <i class="bi bi-arrow-right-circle-fill"></i> Back </a>
                        </div>
                    </div>
                    <div class="row">
                   
                        <div class="col-md-6">
                           @if(!empty($imagePath))
                        <img src="{{ asset('storage/' . $imagePath) }}" alt="Project Image" style="max-width: 300px;">

                        @endif

                        </div>
                        <div class="col-md-12">
                            <h4 class="mt-4">Description</h4>
                            <p>
                                {!! $activity->description !!}
                            </p>
                        </div>

                        <div class="mt-5 mb-5 col-md-12">
                            <hr>
                            <div class="d-flex">
                                <a href="{{route('manage-projects.edit', $activity->id)}}" class="btn btn-success btn-sm me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{route('manage-projects.destroy', $activity->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure ?')">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection