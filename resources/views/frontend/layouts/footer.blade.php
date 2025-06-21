@section('footer')

    <!-- Footer Section -->
    <footer class="footer-section text-white pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="footer-info">
                        <img src="{{url('icons/logo.svg')}}" alt="new super electrician service nepal" class="footer-logo mb-3">
                        <p>
                            {!! $settingData->description !!}
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mb-3 mb-md-0">
                    <h5 class="footer-heading text-light">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{route('index')}}" class="text-light">Home</a></li>
                        <li><a href="{{route('about-us')}}" class="text-light">About Us</a></li>
                        <li><a href="{{route('services')}}" class="text-light">Services</a></li>
                        <li><a href="{{route('projects')}}" class="text-light">Projects</a></li>
                        <li><a href="{{route('gallery')}}" class="text-light">Gallery</a></li>
                        <li><a href="{{route('blogs')}}" class="text-light">Blog</a></li>
                        <li><a href="{{route('contact')}}" class="text-light">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4">
                    <h5 class="footer-heading text-light">Contact Info</h5>
                    <ul class="footer-contact">
                        <li class="text-light"><i class="fas fa-map-marker-alt"></i> {{$settingData->address}}</li>
                        <li class="text-light"><i class="fas fa-phone-alt"></i> {{$settingData->phone}}</li>
                        <li class="text-light"><i class="fas fa-envelope"></i> {{$settingData->email}}</li>
                        <li class="text-light"><i class="fas fa-clock"></i> Mon-Fri: 8:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3 mt-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">&copy; 2010 New Super Electrician Service Nepal. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Boonmatrix</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{'assets/js/frontend.js'}}"></script>
    </body>
    </html>

@endsection
