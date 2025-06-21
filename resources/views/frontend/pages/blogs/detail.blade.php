@extends('frontend.app.main')

@section('content')
<main class="main">

    <!-- Blog Detail Section -->
    <section class="blog-detail section py-5 bg-light">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <article class="blog-details bg-white shadow-sm rounded p-4">
                        <h1 class="fw-bold">Title: {{ $blog->title }}</h1>
                         @if(isset($blog->files_field['thumbnail']))
                                    <img src="{{ url($blog->files_field['thumbnail']) }}"
                                         alt="{{ $blog->title }}"
                                         class="img-fluid"
                                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;">
                                @endif

                        <div class="meta-top mb-3 text-muted d-flex flex-wrap gap-4 align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person me-2" aria-hidden="true"></i>
                                <span>{{ optional($blog->user)->name ?? 'Admin' }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-2" aria-hidden="true"></i>
                                <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
                            </div>
                            @if($blog->category)
                            <div class="d-flex align-items-center">
                                <i class="bi bi-folder me-2" aria-hidden="true"></i>
                                <a href="{{ route('blogs', ['category' => optional($blog->category)->id]) }}" class="text-decoration-none">
                                    {{ optional($blog->category)->name }}
                                </a>
                            </div>
                            @endif
                        </div>

                        <div class="text-document-content" style="line-height: 1.7; color: #333;">
                            {!! $blog->description !!}
                        </div>

                    </article>
                </div>
                
                <!-- Sidebar -->
                <aside class="col-lg-4">
                    <div class="sidebar">
                        <!-- Search Form -->
                        <div class="mb-4 service-card p-3 bg-white shadow-sm rounded">
                            <h3 class="card-title mb-3">Search</h3>
                            <form action="{{ route('blogs') }}" method="get" class="d-flex" role="search">
                                <input type="search" name="search" class="form-control me-2" placeholder="Search blogs..." value="{{ request('search') }}" aria-label="Search blogs">
                                <button type="submit" class="btn btn-primary" style="background-color: var(--accent-color); border-color: var(--accent-color);">
                                    <i class="bi bi-search"></i>
                                    <span class="visually-hidden">Search</span>
                                </button>
                            </form>
                        </div>
                        
                        <!-- Categories -->
                        <div class="mb-4 service-card p-3 bg-white shadow-sm rounded">
                            <h3 class="card-title mb-3">Categories</h3>
                            <ul class="list-group list-group-flush">
                                @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blogs', ['category' => $category->id]) }}" class="text-decoration-none text-dark">
                                        {{ $category->name }}
                                    </a>
                                    <span class="badge rounded-pill" style="background-color: var(--accent-color);">{{ $category->blogs_count }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Recent Posts -->
                        <div class="service-card p-3 bg-white shadow-sm rounded">
                            <h3 class="card-title mb-3">Recent Posts</h3>
                            <div>
                                @foreach($recentPosts as $post)
                                <div class="d-flex border-bottom pb-3 mb-3">
                                    @if($post->image)
                                    <img src="{{ url($post->image) }}" alt="{{ $post->title }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <h5 class="mb-1" style="font-size: 16px;">
                                            <a href="{{ route('blogs', $post->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($post->title, 50) }}</a>
                                        </h5>
                                        <time datetime="{{ $post->created_at }}" class="text-muted" style="font-size: 12px;">
                                            <i class="bi bi-calendar-date"></i> {{ $post->created_at->format('M d, Y') }}
                                        </time>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>
@endsection
