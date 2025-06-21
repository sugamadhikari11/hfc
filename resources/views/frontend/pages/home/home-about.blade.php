<?php
$aboutData = \App\Models\Page\Page::where('page_section_name', 'about-us')->first();
?>

<section id="about" class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center justify-content-between">

                   <!-- Content Section -->
        <div class="col-lg-6 text-center text-lg-start">
            <h6 class="text-uppercase text-primary fw-bold">About the Council</h6>
            <h2 class="display-6 fw-bold mb-3">{{ $aboutData->title ?? 'Our Mission for Justice' }}</h2>

            <p class="text-muted fs-5">
                {!! $aboutData->description ?? 'We are committed to upholding human rights, ensuring justice for prisoners, and working toward a fair and transparent judiciary in Nepal.' !!}
            </p>

            <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-4">
                Contact Us for Support
            </a>
        </div>

            <!-- Image Section -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="position-relative about-image-wrapper">
                    <picture>
                        @if (!empty($aboutData->files_field['desktop']))
                            <source media="(min-width: 1200px)" srcset="{{ url($aboutData->files_field['desktop']) }}">
                        @endif
                        @if (!empty($aboutData->files_field['image_tablet']))
                            <source media="(min-width: 768px)" srcset="{{ url($aboutData->files_field['image_tablet']) }}">
                        @endif
                        @if (!empty($aboutData->files_field['image_mobile']))
                            <source media="(min-width: 480px)" srcset="{{ url($aboutData->files_field['image_mobile']) }}">
                        @endif
                        <img src="{{ url($aboutData->files_field['thumbnail'] ?? $aboutData->files_field['original'] ?? url('images/demo.webp')) }}"
                             alt="{{ $aboutData->title }}" class="img-fluid rounded shadow">
                    </picture>
                </div>
            </div>



        </div>
    </div>
</section>
