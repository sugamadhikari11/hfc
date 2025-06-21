@section('header')
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frontend.layouts.meta-data')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{url('assets/css/frontend.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/app.css')}}">
</head>
<body>
<div class="top-header text-white py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="contact-info">
                    <span><i class="fas fa-phone-alt me-2"></i> Call Us: {{$settingData->phone}}</span>
                    <span class="ms-3 d-none d-md-inline"><i class="fas fa-envelope me-2"></i>
                        Email: {{$settingData->email}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="social-links d-flex justify-content-end">
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <!-- Logo & Brand -->
            <div class="logo">
                <img src="{{ url('icons/logo.png') }}" alt=""> Human Rights And Prisories-Judicial Council Nepal
            </div>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav links -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about-us') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects') }}">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>

                <!-- Donate Button -->
                <div class="ms-3 d-flex align-items-center">
                    <a href="{{ route('donate') }}" class="btn btn-warning fw-semibold px-4 py-2 rounded-pill">
                        <i class="bi bi-heart-fill me-1"></i> Donate
                    </a>
                </div>

            </div>
        </div>
    </nav>

</header>
@endsection