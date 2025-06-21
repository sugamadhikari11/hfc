@php
    $testimonialData = \App\Models\Testimonial\Testimonial::all();
@endphp

<section class="testimonial-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary">TESTIMONIALS</h6>
            <h2 class="section-title">What Our Clients Say</h2>
            <p class="section-subtitle">Read what our satisfied customers have to say about our services</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($testimonialData as $key => $testimonial)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="testimonial-item text-center">
                                    <div class="testimonial-img mb-3">
                                        @if($testimonial->image)
                                            <img src="{{ url($testimonial->image) }}" alt="Client"
                                                 class="rounded-circle" width="100">
                                        @else
                                            <img src="{{ url('icons/user.png') }}"
                                                 alt="Client" class="rounded-circle" width="100">
                                        @endif
                                    </div>
                                    <div class="testimonial-content">
                                        <p class="testimonial-text">{!! $testimonial->description  !!}</p>
                                        <h5 class="client-name">{{ $testimonial->name }}</h5>
                                        <span class="client-position">{{ $testimonial->position }}</span>
                                        <div class="rating text-warning">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fas fa-star{{ $i >= $testimonial->rating ? '-o' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
