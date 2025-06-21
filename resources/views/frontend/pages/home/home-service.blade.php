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

        <!-- Services Grid -->
        <div class="row g-4">
            @foreach($serviceData->children as $service)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
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
</section>