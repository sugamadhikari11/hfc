// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Back to Top button
    const backToTopButton = document.querySelector('.back-to-top');

    if (backToTopButton) {
        // Show/hide back to top button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });

        // Smooth scroll to top when button is clicked
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Add animation to service boxes on scroll
    const animateBoxes = document.querySelectorAll('.animate-box');

    if (animateBoxes.length > 0) {
        // Function to check if element is in viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.bottom >= 0
            );
        }

        // Initial check for elements in viewport
        animateBoxes.forEach(function(box) {
            if (isInViewport(box)) {
                box.style.opacity = '1';
                box.style.transform = 'translateY(0)';
            } else {
                box.style.opacity = '0';
                box.style.transform = 'translateY(20px)';
            }
        });

        // Check on scroll
        window.addEventListener('scroll', function() {
            animateBoxes.forEach(function(box) {
                if (isInViewport(box)) {
                    box.style.opacity = '1';
                    box.style.transform = 'translateY(0)';
                }
            });
        });
    }

    // Smooth scroll for navigation links
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link, .footer-links a');

    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Only apply to links that start with #
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();

                const targetId = this.getAttribute('href');

                // Skip if it's just #
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }

                    // Scroll to target
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // Adjust for header height
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Add active class to nav links on scroll
    window.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section[id]');
        const scrollPosition = window.pageYOffset + 100; // Adjust for header height

        sections.forEach(function(section) {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                document.querySelector('.navbar-nav .nav-link[href="#' + sectionId + '"]')?.classList.add('active');
            } else {
                document.querySelector('.navbar-nav .nav-link[href="#' + sectionId + '"]')?.classList.remove('active');
            }
        });
    });

    // Gallery lightbox functionality (simple version)
    const galleryLinks = document.querySelectorAll('.gallery-link');

    galleryLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            // Here you would typically open a lightbox
            // For a simple implementation, you could use:
            // alert('Lightbox would open here with: ' + this.querySelector('img').getAttribute('src'));

            // For a real implementation, you would use a lightbox library like:
            // - Fancybox
            // - Lightbox2
            // - GLightbox
            // etc.
        });
    });

    // Make header sticky on scroll
    const header = document.querySelector('.header');
    const headerHeight = header.offsetHeight;
    const topHeader = document.querySelector('.top-header');
    const topHeaderHeight = topHeader ? topHeader.offsetHeight : 0;

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > topHeaderHeight) {
            header.classList.add('sticky-header');
            document.body.style.paddingTop = headerHeight + 'px';
        } else {
            header.classList.remove('sticky-header');
            document.body.style.paddingTop = '0';
        }
    });

    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize Bootstrap popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});