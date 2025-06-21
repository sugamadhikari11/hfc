@extends('frontend.app.main')

@section('content')
<main class="main">
    <!-- Page Title -->
    <section class="page-section">
        <header class="section-header">
            <h1>Our Blog</h1>
        </header>
    </section><!-- End Page Title -->

    <!-- Blog Section -->
    <section class="blog section">
        <!-- Section Title -->
        <div class="container section-title mt-5" data-aos="fade-up">
            <p>Latest News & Insights</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="row gy-4">
                        @forelse($blogs as $blog)
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <article class="service-card blog-post">
                                @if(isset($blog->files_field['thumbnail']))
                                    <img src="{{ url($blog->files_field['thumbnail']) }}"
                                         alt="{{ $blog->title }}"
                                         class="img-fluid"
                                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;">
                                @endif
                                <div class="card-body">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <span class="post-category">{{ optional($blog->category)->name }}</span>
                                        <span class="post-date">
                                            <i class="bi bi-calendar-event"></i>
                                            <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
                                        </span>
                                    </div>
                                    <h2 class="card-title">
                                        <a href="{{ route('blogs', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h2>
                                    <div class="content">
                                        <p>{{ Str::limit(strip_tags($blog->summary), 150) }}</p>
                                        <a href="{{ route('blogs', $blog->slug) }}" class="view-all">Read More <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @empty
                        <div class="text-center col-12">
                            <div class="alert alert-info">No blog posts found.</div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 blog-pagination">
                        <div class="d-flex justify-content-center">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- Search Form -->
                        <div class="mb-4 service-card">
                            <h3 class="card-title">Search</h3>
                            <form action="{{ route('blogs') }}" method="get" class="mt-3">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search articles...">
                                    <button type="submit" class="btn" style="background-color: var(--accent-color); color: white;">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="mb-4 service-card">
                            <h3 class="card-title">Categories</h3>
                            <ul class="mt-3 list-group list-group-flush">
                                @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('blogs', ['category' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                    <span class="badge rounded-pill" style="background-color: var(--accent-color);">{{ $category->blogs_count }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Recent Posts -->
                        <div class="service-card">
                            <h3 class="card-title">Recent Posts</h3>
                            <div class="mt-3">
                                @if($recentPosts->isEmpty())
                                    <div class="alert alert-warning">No recent posts found.</div>
                                @else
                                    @foreach($recentPosts as $post)
                                    <div class="pb-3 mb-3 d-flex border-bottom">
                                        @if(isset($post->files_field['thumbnail']))
                                            <img src="{{ url($post->files_field['thumbnail']) }}"
                                                 alt="{{ $post->title }}"
                                                 class="flex-shrink-0 rounded me-3"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <h5 style="font-size: 16px; margin-bottom: 5px">
                                                <a href="{{ route('blogs', $post->slug) }}">{{ Str::limit($post->title, 50) }}</a>
                                            </h5>
                                            <time datetime="{{ $post->created_at }}" style="font-size: 12px; color: var(--accent-color);">
                                                <i class="bi bi-calendar-date"></i> {{ $post->created_at->format('M d, Y') }}
                                            </time>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Blog Section -->
</main>
@endsection
