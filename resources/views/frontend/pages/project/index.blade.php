@extends('frontend.app.main')

@section('content')
<main class="main">
    <!-- Page Title -->
    <section class="page-section">
        <header class="section-header">
            <h1>Our Projects</h1>
        </header>
    </section><!-- End Page Title -->

    <!-- Projects Section -->
    <section id="projects" class="portfolio section">
        <div class="container" data-aos="fade-up">
            <div class="section-title mt-5">
                <p>Our Recent Work</p>
            </div>

            <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                @forelse($projects as $project)
                    <div class="mb-4 col-lg-4 col-md-6">
                        <div class="project-card h-100">
                            <div class="position-relative">
                                @php
                                    $files = json_decode($project->files_field, true);
                                    $imagePath = $files['image'] ?? null;
                                @endphp

                                @if ($imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid w-100" alt="{{ $project->title }}" 
                                         style="height: 250px; object-fit: cover;">
                                @else
                                    <div style="height: 250px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif

                                <div class="portfolio-info px-3 py-4">
                                    @if($project->url)
                                        <h4>
                                            <a href="{{ $project->url }}" target="_blank" rel="noopener" class="text-black text-decoration-none">
                                                {{ $project->title }}
                                            </a>
                                        </h4>
                                    @else
                                        <h4 class="text-black">{{ $project->title }}</h4>
                                    @endif

                                    <p class="mt-2">{{ Str::limit(strip_tags($project->description), 80) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <p>No projects found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($projects) && method_exists($projects, 'links'))
                <div class="mt-5 d-flex justify-content-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section><!-- End Projects Section -->
</main>
@endsection

@push('styles')
<style>
    .project-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-10px);
    }
    .portfolio-info {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: center;
        z-index: 3;
        transition: all ease-in-out 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.85); /* light background for black text */
        padding: 20px 24px;
    }

    .portfolio-info h4 {
        font-size: 18px;
        color: #000; /* black text */
        font-weight: 600;
        margin-bottom: 12px;
    }

    .portfolio-info h4 a {
        color: #000;
        transition: color 0.3s ease;
    }

    .portfolio-info h4 a:hover {
        color: #444;
        text-decoration: underline;
    }

    .portfolio-info p {
        color: rgba(0, 0, 0, 0.85); /* black text */
        font-size: 14px;
        margin: 0;
    }

        /* Removed icons so no styles for them */

    .project-card:hover .portfolio-info {
        opacity: 1;
    }
</style>
@endpush
