<?php
$blogData = \App\Models\Blog\Blog::limit(3)->get();
?>
<section id="blog" class="blog-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h6 class="text-primary">OUR BLOG</h6>
                <h2 class="section-title">Latest News & Tips</h2>
                <p class="section-subtitle">Stay updated with electrical tips, industry news, and company updates</p>
            </div>
        </div>
        <div class="row">
            @foreach($blogData as $blog)
                <div class="col-md-4 mb-4">
                    <div class="blog-card">
                        <div class="blog-img">
                            <picture>
                                   @if(isset($blog->files_field['thumbnail']))
                                    <img src="{{ url($blog->files_field['thumbnail']) }}"
                                         alt="{{ $blog->title }}"
                                         class="img-fluid"
                                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px 8px 0 0;">
                                @endif
                            </picture>
                            <div class="blog-date">
                                <span class="day">
                                    {{$blog->created_at->format('d')}}
                                </span>
                                <span class="month">
                                    {{$blog->created_at->format('M')}}
                                </span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="fas fa-user me-1"></i>
                                    <a href="#">{{$blog->user->name}}</a>
                                </span>
                            </div>
                            <h4 class="blog-title">
                                <a href="{{route('blogs',$blog->slug)}}">{{$blog->title}}</a>
                            </h4>
                            <p>
                                {!! $blog->summary !!}
                            </p>
                            <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-primary">View All Posts</a>
        </div>
    </div>
</section>
