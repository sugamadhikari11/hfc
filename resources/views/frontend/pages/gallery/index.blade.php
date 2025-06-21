@extends('frontend.app.main')

@section('content')
<main class="main">
    <section class="page-section">
        <header class="section-header">
                <h1>Our Gallery</h1>
        </header>
    </section><!-- End Page Title -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">
        <div class="container" data-aos="fade-up">

            <!-- Gallery Filter Buttons -->
            <div class="gallery-filters" data-aos="fade-up" data-aos-delay="100">
                <ul>
                    @foreach ($galleryCategories as $category)
                        <li data-filter=".filter-{{ \Str::slug($category->name) }}">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Gallery Items -->
        <div class="row g-4 gallery-container">
            @forelse($galleryImages as $item)
                @php
                    $imagePath = $item['image'] ?? null;
                    $imgUrl = $imagePath
                        ? (filter_var($imagePath, FILTER_VALIDATE_URL) ? $imagePath : asset($imagePath))
                        : asset('assets/img/no-image.jpg');

                    $categorySlug = isset($item['category']) ? \Str::slug($item['category']->name) : 'uncategorized';
                    $title = $item['title'] ?? 'Gallery Image';
                @endphp

                <div class="col-6 col-md-4 col-lg-3 gallery-item filter-{{ $categorySlug }}">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <a href="{{ $imgUrl }}" class="glightbox" data-gallery="images-gallery">
                                <img src="{{ $imgUrl }}" class="card-img-top" alt="{{ $title }}">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 opacity-0 hover-opacity-100">
                                    <i class="bi bi-search text-white fs-2"></i>
                                </div>
                            </a>
                        </div>
                        <div class="card-body p-2 text-center">
                            <p class="card-text mb-0 fw-semibold small text-truncate">{{ $title }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No images found.</p>
                </div>
            @endforelse
        </div>


            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $galleryImages->links() }}
            </div>
        </div>
    </section><!-- End Gallery Section -->
</main>
@endsection

@push('scripts')
<!-- Isotope & GLightbox CDN -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var galleryContainer = document.querySelector('.gallery-container');
        if (galleryContainer) {
            var iso = new Isotope(galleryContainer, {
                itemSelector: '.gallery-item',
                layoutMode: 'fitRows'
            });

            document.querySelectorAll('.gallery-filters li').forEach(function (filterBtn) {
                filterBtn.addEventListener('click', function () {
                    document.querySelectorAll('.gallery-filters li').forEach(btn => btn.classList.remove('filter-active'));
                    this.classList.add('filter-active');
                    var filterValue = this.getAttribute('data-filter');
                    iso.arrange({ filter: filterValue });
                });
            });

            GLightbox({ selector: '.glightbox' });
        }
    });
</script>
@endpush
