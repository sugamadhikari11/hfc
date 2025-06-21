<!-- Projects Section -->
<section id="projects" class="projects-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h6 class="text-primary">OUR PROJECTS</h6>
                <h2 class="section-title">Recent Electrical Projects</h2>
                <p class="section-subtitle">Take a look at some of our recent work</p>
            </div>
        </div>

        <div class="row">
            @foreach ($projects->take(3) as $project)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="project-card h-100 d-flex flex-column shadow-sm rounded overflow-hidden border">
                        <!-- Project Image -->
                        <div class="project-img">
                            @php
                                $files = json_decode($project->files_field, true);
                                $imagePath = $files['image'] ?? null;
                            @endphp

                            @if ($imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                     class="img-fluid w-100" 
                                     alt="{{ $project->title }}" 
                                     style="height: 250px; object-fit: cover;">
                            @else
                                <div style="height: 250px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif

                            <div class="project-overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 opacity-0 hover-opacity-100 transition">
                                <a href="#" class="project-link text-white"><i class="fas fa-link fa-lg"></i></a>
                            </div>
                        </div>

                        <!-- Project Info -->
                        <div class="project-info d-flex flex-column flex-grow-1 p-3">
                            <h4 class="fw-semibold">{{ $project->title }}</h4>
                            <p class="text-muted">{!! Str::limit($project->description, 80) !!}</p>

                            @if($project->url)
                                <a href="{{ $project->url }}" target="_blank" title="View Project" class="btn btn-primary mt-auto w-100">
                                    View Project
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-4">
            <a href="{{ route('projects') }}" class="btn btn-primary">View All Projects</a>
        </div>
    </div>
</section>
