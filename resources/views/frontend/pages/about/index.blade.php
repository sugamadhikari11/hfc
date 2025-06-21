@extends('frontend.app.main')

@section('content')
<div class="page-section about-page"> 
    <header class="section-header">
    <h1 class="mb-0">About Us</h1>
  </header>
  <div class="container">
    <!-- Mission Section -->
    <section class="section mission-section">
      <h2>Our Mission</h2>
      <img src="{{ asset('images/mission.jpg') }}" alt="Mission Image" class="mission-image">
      <p>
        HRPJCF Nepal is dedicated to promoting human rights and justice for prisoners and vulnerable populations in Nepal.
        We provide legal support, advocate for policy reforms, and work to ensure dignity and fair treatment for all individuals
        within the criminal justice system.
      </p>
    </section>

    <!-- History Section -->
    <section class="section history-section">
      <h2>History</h2>
      <p>
        Founded in 2007, HRPJCF Nepal has grown into a leading voice for prisoner rights in Nepal. Our organization was
        established by a group of human rights activists and legal professionals determined to combat injustices and improve
        conditions within the nation's prisons. Over the years, we have made significant strides in policy advocacy, legal aid,
        and public awareness.
      </p>
    </section>

    <!-- Team Section -->
    @if($team->count() > 0)
    <section id="team" class="team section">
        <div class="section-title" data-aos="fade-up">
            <h2>Team</h2>
        </div>

        <div class="container mt-5">
            <div class="row gy-5">
                @forelse($team as $member)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="member text-center p-3 shadow rounded bg-white">
                        <div class="pic mb-3 mx-auto">
                            <img src="{{ url($member->image) }}" alt="{{ $member->name }}" class="img-fluid rounded-circle team-img">
                        </div>
                        <div class="member-info">
                            <h4 class="mb-1">{{ $member->name }}</h4>
                            <span class="text-muted d-block mb-3">{{ $member->memberType->type ?? 'Team Member' }}</span>
                            @if(!empty($member->description))
                            <p class="member-description px-2">{{ Str::limit(strip_tags($member->description), 120) }}</p>
                            @endif
                            <div class="social mt-3">
                                @if($member->twitter)
                                <a href="{{ $member->twitter }}" target="_blank" rel="noopener" class="social-icon twitter"><i class="bi bi-twitter"></i></a>
                                @endif
                                @if($member->facebook)
                                <a href="{{ $member->facebook }}" target="_blank" rel="noopener" class="social-icon facebook"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if($member->instagram)
                                <a href="{{ $member->instagram }}" target="_blank" rel="noopener" class="social-icon instagram"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" rel="noopener" class="social-icon linkedin"><i class="bi bi-linkedin"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center col-12">
                    <p>No team members found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
@endpush
