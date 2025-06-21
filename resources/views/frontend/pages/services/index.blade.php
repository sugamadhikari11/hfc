<!-- filepath: /home/sarbada/Desktop/electric/resources/views/frontend/pages/services/index.blade.php -->
@extends('frontend.app.main')

@section('content')
<main class="main">
    <!-- Page Title -->
    <section class="page-section">
        <header class="section-header">
            <h1>{{ $mainServicePage->title }}</h1>
        </header>
    </section><!-- End Page Title -->

    <!-- Services Overview Section -->
    <section class="services-overview section">
        <div class="container" data-aos="fade-up">
            <h4 class="text-center mt-5">{{ $mainServicePage->sub_title }}</h4>
            <div class="overview-content">
                <div class="row">
                    <div class="mx-auto mb-5 text-center col-lg-8">
                        <div class="text-document-content">
                            {!! $mainServicePage->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services List -->
            <div class="mt-4 row gy-4">
                @foreach($servicePages as $service)
                    @php
                        $img = $service->files_field['image'] ?? $service->files_field['thumbnail'] ?? null;
                    @endphp
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="service-card h-100">
                            @if($img)
                                <img src="{{ asset($img) }}" alt="{{ $service->title }}" class="service-image mb-3" style="width: 100%; height: 190px; object-fit: cover; border-radius: 8px;">
                            @endif
                            <div class="card-icon">
                                <i class="{{ $service->icons }}"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->title }}</h5>
                                <p class="card-text">{{ $service->summary }}</p>
                                <a href="{{ route('services', $service->slug) }}" class="read-more">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="services-cta section mb-2 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-lg-8">
                    <h3>Need Professional Electrical Services?</h3>
                    <p>Our team of experienced electricians is ready to help with all your electrical needs.</p>
                    <button class="custom-btn" style="background-color: yellow; border:none; padding: 10px; border-radius: 7px;"><a style="text-decoration: none; color: #000;" href="{{ route('contact') }}">Contact Us Today</a></button>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
 .service-card {
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    height: 100%;
}


.service-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.2);
}

.service-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
}

.card-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: var(--accent-color);
    border-radius: 50%;
    margin-bottom: 20px;
    flex-shrink: 0;
}

.card-icon i {
    font-size: 36px;
    color: #fff;
}

.card-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--default-color);
    text-align: center;
}

.card-text {
    color: var(--text-color);
    margin-bottom: 30px;
    text-align: center;
    flex-grow: 1;
    line-height: 1.5;
    font-size: 15px;
}

.read-more {
    color: var(--accent-color);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    font-size: 15px;
    text-decoration: none;
}

.read-more i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}

.services-cta {
    background-color: #f8f9fa;
    padding: 50px 20px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    text-align: center;
    margin-top: 60px;
}

.services-cta h3 {
    margin-bottom: 20px;
    color: var(--default-color);
    font-weight: 700;
    font-size: 28px;
}

.services-cta p {
    margin-bottom: 30px;
    color: var(--text-color);
    font-size: 17px;
}

@media (max-width: 767.98px) {
    .service-card {
        padding: 20px 15px;
    }
    .card-icon {
        width: 60px;
        height: 60px;
    }
    .card-icon i {
        font-size: 26px;
    }
    .card-title {
        font-size: 20px;
    }
    .card-text {
        font-size: 14px;
    }
    .services-cta {
        padding: 40px 15px;
        margin-top: 40px;
    }
    .services-cta h3 {
        font-size: 24px;
    }
    .services-cta p {
        font-size: 15px;
    }
}

</style>
@endpush
