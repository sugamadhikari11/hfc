<!-- filepath: /home/sarbada/Desktop/electric/resources/views/frontend/pages/services/detail.blade.php -->
@extends('frontend.app.main')

@section('content')
<main class="main">
    <!-- Page Title -->
    <section class="page-title dark-background">
        <!-- Add this background image -->
        <img src="{{ asset('assets/img/hero-bg.avif') }}" alt="" data-aos="fade-in">
        
        <div class="heading">
            <div class="container">
                <h1>{{ $servicePage->title }}</h1>
            </div>
        </div>
    </section><!-- End Page Title -->

    <!-- Service Detail Section -->
    <section class="service-detail section">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="service-content">
                        <div class="section-title">
                            <h2>{{ $servicePage->title }}</h2>
                            <p>{{ $servicePage->sub_title }}</p>
                        </div>

                        @if($servicePage->image)
                        <div class="mb-4 service-image">
                            <img src="{{ asset('storage/'.$servicePage->image) }}" class="rounded img-fluid" alt="{{ $servicePage->title }}">
                        </div>
                        @endif
                        
                        <div class="text-document-content">
                            {!! $servicePage->description !!}
                        </div>
                        
                        <div class="mt-5 service-cta">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Need this service?</h4>
                                <a href="{{ route('contact') }}" class="btn btn-primary">Request a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="service-sidebar">
                        <!-- Services List -->
                        <div class="mb-4 service-card">
                            <h3 class="card-title">Our Services</h3>
                            <ul class="mt-3 list-group list-group-flush">
                                @if($parentPage)
                                    @foreach(App\Models\Page\Page::where('parent_id', $parentPage->id)->where('is_published', 1)->get() as $service)
                                    <li class="list-group-item d-flex align-items-center {{ $service->id == $servicePage->id ? 'active' : '' }}">
                                        <i class="{{ $service->icons }} me-2" style="color: var(--accent-color);"></i>
                                        <a href="{{ route('services', $service->slug) }}" class="{{ $service->id == $servicePage->id ? 'fw-bold' : '' }}">
                                            {{ $service->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="service-card">
                            <h3 class="card-title">Need Help?</h3>
                            <div class="contact-info">
                                <div class="mb-3 info-item d-flex align-items-center">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Call Us</h5>
                                        <p class="mb-0">{{ optional(App\Models\Setting\Setting::first())->phone ?? '(123) 456-7890' }}</p>
                                    </div>
                                </div>
                                <div class="mb-4 info-item d-flex align-items-center">
                                    <div class="icon-box me-3">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Email Us</h5>
                                        <p class="mb-0">{{ optional(App\Models\Setting\Setting::first())->email ?? 'info@example.com' }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('contact') }}" class="text-center btn btn-primary w-100">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Services -->
            @if(count($relatedServices) > 0)
            <div class="mt-5 related-services">
                <div class="text-center section-title">
                    <h2>Other Services</h2>
                    <p>You might also be interested in</p>
                </div>
                
                <div class="mt-4 row gy-4">
                    @foreach($relatedServices as $relatedService)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="service-card h-100">
                            <div class="card-icon">
                                <i class="{{ $relatedService->icons }}"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedService->title }}</h5>
                                <p class="card-text">{{ Str::limit($relatedService->summary, 100) }}</p>
                                <a href="{{ route('services', $relatedService->slug) }}" class="read-more">Learn More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection

@section('styles')
<style>
    /* Service Detail Page Styling */
    .service-content {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
    
    .service-content .section-title {
        text-align: left;
        margin-bottom: 30px;
    }
    
    .service-content .section-title h2 {
        font-size: 28px;
        font-weight: 700;
        color: var(--default-color);
    }
    
    .service-image {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .service-cta {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    
    .service-cta h4 {
        margin-bottom: 0;
        color: var(--default-color);
        font-weight: 600;
    }
    
    .service-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .card-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
        color: var(--default-color);
    }
    
    .card-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background: var(--accent-color);
    }
    
    .list-group-item {
        border-color: #f0f0f0;
        padding: 12px 0;
    }
    
    .list-group-item.active {
        background-color: rgba(var(--accent-color-rgb), 0.05);
        border-color: #f0f0f0;
    }
    
    .list-group-item a {
        color: var(--default-color);
        text-decoration: none;
        display: block;
        transition: all 0.3s;
    }
    
    .list-group-item a:hover {
        color: var(--accent-color);
    }
    
    .icon-box {
        width: 40px;
        height: 40px;
        background: var(--accent-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon-box i {
        color: #fff;
        font-size: 18px;
    }
    
    .info-item h5 {
        font-size: 16px;
        font-weight: 600;
        color: var(--default-color);
    }
    
    .info-item p {
        color: #666;
    }
    
    .card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        background: var(--accent-color);
        border-radius: 50%;
        margin-bottom: 20px;
    }
    
    .card-icon i {
        font-size: 32px;
        color: #fff;
    }
    
    .card-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--default-color);
    }
    
    .card-text {
        color: #666;
        margin-bottom: 25px;
    }
    
    .read-more {
        color: var(--accent-color);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    
    .read-more i {
        margin-left: 5px;
        transition: all 0.3s ease;
    }
    
    .read-more:hover i {
        transform: translateX(5px);
    }
</style>
@endsection