<?php
$columnName = ['logo', 'favicon'];

?>
@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-3 mb-2 col-md-12">
                                    <h2><i class="bi bi-gear"></i> Setting
                                        <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm float-end">
                                            <i class="bi bi-arrow-left"></i>
                                            Goto Dashboard</a>
                                    </h2>
                                    <hr>
                                    @include('backend.layouts.message')
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{ route('setting') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Default Tabs -->
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="general-tab"
                                                                data-bs-toggle="tab" data-bs-target="#general"
                                                                type="button" role="tab" aria-controls="general"
                                                                aria-selected="true">General
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                                data-bs-target="#contact" type="button" role="tab"
                                                                aria-controls="contact" aria-selected="true">Contact
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="logo-icons-tab"
                                                                data-bs-toggle="tab" data-bs-target="#logo" type="button"
                                                                role="tab" aria-controls="log" aria-selected="false"
                                                                tabindex="-1">Logo & Icons
                                                            </button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab"
                                                                data-bs-target="#seo" type="button" role="tab"
                                                                aria-controls="seo" aria-selected="false" tabindex="-1">SEO
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="google-maps-tab"
                                                                data-bs-toggle="tab" data-bs-target="#google-maps"
                                                                type="button" role="tab" aria-controls="google-maps"
                                                                aria-selected="false" tabindex="-1">Google maps
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="company-info-tab"
                                                                data-bs-toggle="tab" data-bs-target="#company-info"
                                                                type="button" role="tab" aria-controls="company-info"
                                                                aria-selected="false" tabindex="-1">Company Info
                                                            </button>
                                                        </li>

                                                    </ul>
                                                    <div class="pt-2 mt-3 tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="general"
                                                            role="tabpanel" aria-labelledby="general-tab">
                                                            <div class="mb-3 form-group">
                                                                <label for="name">Name:
                                                                    <a style="color: red;">{{ $errors->first('name') }}</a>
                                                                </label>
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control"
                                                                    value="{{ $settingData->name ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="sub_name">Sub Name:
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('sub_name') }}</a>
                                                                </label>
                                                                <input type="text" id="sub_name" name="sub_name"
                                                                    class="form-control"
                                                                    value="{{ $settingData->sub_name ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="slogan">Slogan:
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('slogan') }}</a>
                                                                </label>
                                                                <input type="text" id="slogan" name="slogan"
                                                                    class="form-control"
                                                                    value="{{ $settingData->slogan ?? '' }}">
                                                            </div>


                                                            <div class="mb-2 form-group">
                                                                <label for="description">Description:
                                                                    <a
                                                                        style="color: red;">{{ $errors->first('description') }}</a>
                                                                </label>
                                                                <textarea name="description" id="description" class="form-control">{{ $settingData->description ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="contact" role="tabpanel"
                                                            aria-labelledby="contact-tab">

                                                            <div class="mb-3 form-group">
                                                                <label for="email">Email</label>
                                                                <input type="text" id="email" name="email"
                                                                    value="{{ $settingData->email ?? '' }}"
                                                                    class="form-control">
                                                                <span class="text-danger">
                                                                    if you want to add multiple email then separate by
                                                                    comma(,)
                                                                </span>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="phone">Phone</label>
                                                                <input type="text" id="phone" name="phone"
                                                                    value="{{ $settingData->phone ?? '' }}"
                                                                    class="form-control">
                                                                <span class="text-danger">
                                                                    if you want to add multiple phone then separate by
                                                                    comma(,)
                                                                </span>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="mobile">Mobile</label>
                                                                <input type="text" id="mobile" name="mobile"
                                                                    value="{{ $settingData->mobile ?? '' }}"
                                                                    class="form-control">
                                                                <span class="text-danger">
                                                                    if you want to add multiple mobile then separate by
                                                                    comma(,)
                                                                </span>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" id="address"
                                                                    value="{{ $settingData->address ?? '' }}"
                                                                    class="form-control">
                                                            </div>


                                                        </div>
                                                        <div class="tab-pane fade" id="logo" role="tabpanel"
                                                            aria-labelledby="logo-icons-tab">
                                                            <div class="row">
                                                                @include('backend.layouts.update-image', [
                                                                    'tableName' => $settingData->getTable(),
                                                                    'id' => $settingData->id,
                                                                ])
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="seo" role="tabpanel"
                                                            aria-labelledby="seo-tab">
                                                            <div class="mb-3 form-group">
                                                                <label for="meta_title">Meta Title:</label>
                                                                <input type="text" id="meta_title" name="meta_title"
                                                                    class="form-control"
                                                                    value="{{ $settingData->meta_title ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="meta_description">Meta Description:</label>
                                                                <textarea name="meta_description" id="meta_description" class="form-control">{{ $settingData->meta_description ?? '' }}</textarea>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="meta_keywords">Meta Keywords:</label>
                                                                <textarea name="meta_keywords" id="meta_keywords" class="form-control">{{ $settingData->meta_keywords ?? '' }}</textarea>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="google-maps" role="tabpanel"
                                                            aria-labelledby="google-maps-tab">
                                                            <h1>Google maps</h1>
                                                            <textarea class="form-control" name="google_map">  {!! $settingData->google_map !!}</textarea>
                                                            <hr>
                                                            <h1>Show Maps</h1>
                                                            <p>
                                                                {!! $settingData->google_map !!}
                                                            </p>
                                                        </div>
                                                        <div class="tab-pane fade" id="company-info" role="tabpanel"
                                                            aria-labelledby="company-info-tab">
                                                            <div class="mb-3 form-group">
                                                                <label for="years_experience">Years of Experience:</label>
                                                                <input type="number" id="years_experience"
                                                                    name="years_experience" class="form-control"
                                                                    value="{{ $settingData->years_experience ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="mission">Mission:</label>
                                                                <textarea name="mission" id="mission" class="form-control" rows="4">{{ $settingData->mission ?? '' }}</textarea>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="vision">Vision:</label>
                                                                <textarea name="vision" id="vision" class="form-control" rows="4">{{ $settingData->vision ?? '' }}</textarea>
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="happy_clients">Happy Clients:</label>
                                                                <input type="number" id="happy_clients"
                                                                    name="happy_clients" class="form-control"
                                                                    value="{{ $settingData->happy_clients ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="projects_completed">Projects Completed:</label>
                                                                <input type="number" id="projects_completed"
                                                                    name="projects_completed" class="form-control"
                                                                    value="{{ $settingData->projects_completed ?? '' }}">
                                                            </div>
                                                            <div class="mb-3 form-group">
                                                                <label for="running_projects">Running Projects:</label>
                                                                <input type="number" id="running_projects"
                                                                    name="running_projects" class="form-control"
                                                                    value="{{ $settingData->running_projects ?? '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 col-md-12">
                                            <button class="btn btn-primary w-100">Save</button>
                                        </div>

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
        $(document).ready(function() {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection
