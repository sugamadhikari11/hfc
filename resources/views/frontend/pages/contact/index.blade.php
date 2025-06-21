@extends('frontend.app.main')
@section('content')
    <main id="main">
        <section class="page-section">
            <header class="section-header">
                <h1>Contact Us</h1>
            </header>
        </section>

        <section id="contact" class="contact py-5">
            <div class="container">
                <div class="row g-4">

                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0 p-4 h-100">
                            <div class="mb-4">
                                <i class="bi bi-geo-alt fs-4 text-primary"></i>
                                <h5 class="fw-bold">Location</h5>
                                <p class="text-muted mb-0">{{ $settings->address ?? 'Address not available' }}</p>
                            </div>
                            <div class="mb-4">
                                <i class="bi bi-envelope fs-4 text-primary"></i>
                                <h5 class="fw-bold">Email</h5>
                                <p class="text-muted mb-0">{{ $settings->email ?? 'Email not available' }}</p>
                            </div>
                            <div>
                                <i class="bi bi-phone fs-4 text-primary"></i>
                                <h5 class="fw-bold">Call</h5>
                                <p class="text-muted mb-0">{{ $settings->phone ?? 'Phone not available' }}</p>
                            </div>
                            @if(!empty($settings->map_iframe))
                                <div class="mt-4">
                                    <div class="ratio ratio-4x3">
                                        {!! $settings->map_iframe !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 p-4">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="needs-validation"
                                  novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name"
                                               value="{{ old('name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email"
                                               value="{{ old('email') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" class="form-control"
                                               placeholder="Phone (optional)" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="subject" class="form-control" placeholder="Subject"
                                               value="{{ old('subject') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" rows="5" class="form-control" placeholder="Message"
                                                  required>{{ old('message') }}</textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="mt-5">
                    <div class="ratio ratio-16x9 rounded shadow">
                        <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.317136163925!2d85.28493314874444!3d27.708954252245615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600!5e0!3m2!1sen!2snp!4v1747883488257!5m2!1sen!2snp"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
