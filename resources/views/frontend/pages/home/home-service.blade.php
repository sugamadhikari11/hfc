<?php
$serviceData = \App\Models\Page\Page::where('page_section_name', 'services')->first();
?>

<section id="services" class="services-section py-5 bg-light">
    <div class="container">
           <!-- Section Title -->
      <div class=" text-center" data-aos="fade-up">
            <h2 class="fw-bold">Our Services</h2>
            <div class="title-line my-3"></div>
            <p class="text-muted fs-6">We offer a comprehensive range of electrical services to meet all your needs</p>
        </div>

        <!-- Carousel Wrapper -->
<div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        @php
            $chunks = $serviceData->children->chunk(3); // Show 3 cards per slide
        @endphp

        @foreach($chunks as $chunkIndex => $chunk)
            <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                <div class="row g-4">
                    @foreach($chunk as $service)
                        <div class="col-lg-4">
                            <div class="card h-100 shadow-sm border-0">
                                @php
                                    $imagePath = $service->files_field['thumbnail'] ?? null;
                                @endphp

                                @if($imagePath)
                                    <img src="{{ url($imagePath) }}" alt="{{ $service->title }}" class="card-img-top object-fit-cover" style="height: 220px;">
                                @else
                                    <img src="{{ url('icons/notfound.png') }}" alt="Image Not Found" class="card-img-top object-fit-cover" style="height: 220px;">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-semibold">{{ $service->title }}</h5>
                                    <p class="card-text text-muted flex-grow-1">{!! $service->summary !!}</p>
                                    <a href="{{ route('services', $service->slug) }}" class="btn btn-primary mt-auto align-self-start">
                                        Learn More <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>

    <!-- Bottom Controls -->
    <div class="d-flex justify-content-center gap-3 mt-4">
        <button class="btn btn-outline-primary" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
            <i class="fas fa-chevron-left me-1"></i> Prev
        </button>
        <button class="btn btn-outline-primary" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
            Next <i class="fas fa-chevron-right ms-1"></i>
        </button>
    </div>
</div>

    </div>
</section>