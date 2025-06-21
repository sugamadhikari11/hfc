@extends('frontend.app.main')

@section('content')
<main id="main">
    <!-- Page Title -->
    <section class="page-section bg-light">
        <header class="section-header text-center">
            <h1 class="display-5 fw-bold">Donate Us</h1>
        </header>
    </section>

    <!-- Donate Section -->
    <section id="donate" class="py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!-- Volunteer Card -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Become a Volunteer</h4>
                            <p class="card-text text-muted">
                                Join us in making a difference. As a volunteer, you’ll be helping to spread awareness, assist in events, and support communities that need it most.
                            </p>
                            <a href="{{ route('about-us') }}" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Donate Card -->
                <div class="col-md-6">
                    <div class="card border-0 shadow p-4">
                        <h3 class="mb-3 text-primary">Support Our Cause</h3>
                        <p class="text-muted">
                            We work to protect the rights of the vulnerable and ensure fair treatment for all. Your generous donation helps us continue legal aid, awareness programs, and human rights advocacy.
                        </p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Legal Aid for Prisoners</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Human Rights Education</li>
                            <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i> Community Outreach Programs</li>
                        </ul>
                        <a href="#" class="btn btn-warning btn-lg mt-3">Donate Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
