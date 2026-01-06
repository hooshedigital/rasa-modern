/**
 * Rasa System v3.5 - Main JavaScript
 */

(function($) {
    'use strict';
    
    // Document Ready
    $(document).ready(function() {
        
        // Preloader
        $(window).on('load', function() {
            $('.preloader').fadeOut(500);
        });
        
        // Mobile Menu Toggle
        $('#hamburger').on('click', function() {
            $('#mobileMenu').addClass('active');
            $('#mobileOverlay').fadeIn();
            $('body').css('overflow', 'hidden');
        });
        
        // Close Mobile Menu
        $('#mobileClose, #mobileOverlay').on('click', function() {
            $('#mobileMenu').removeClass('active');
            $('#mobileOverlay').fadeOut();
            $('body').css('overflow', 'auto');
        });
        
        // Theme Switcher
        $('.theme-switcher').on('click', function() {
            const currentTheme = $('html').attr('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            $('html').attr('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update switcher position
            $(this).toggleClass('active');
        });
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        $('html').attr('data-theme', savedTheme);
        if (savedTheme === 'light') {
            $('.theme-switcher').addClass('active');
        }
        
        // Back to Top
        $('.back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 800);
        });
        
        // Scroll Indicator
        $(window).on('scroll', function() {
            const scrollPosition = $(window).scrollTop();
            
            if (scrollPosition > 100) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });
        
        // Smooth Scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            if (this.hash !== '') {
                e.preventDefault();
                const hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 80
                }, 800);
            }
        });
        
        // Newsletter Form
        $('#newsletterForm, #newsletterFooterForm').on('submit', function(e) {
            e.preventDefault();
            const email = $(this).find('input[type="email"]').val();
            
            if (email) {
                // Simulate submission
                $(this).find('button').html('<i class="fas fa-spinner fa-spin"></i> در حال ارسال...');
                
                setTimeout(() => {
                    $(this).find('button').html('<i class="fas fa-check"></i> موفق!');
                    $(this).find('input[type="email"]').val('');
                    
                    setTimeout(() => {
                        $(this).find('button').html('<i class="fas fa-paper-plane"></i> عضویت در خبرنامه');
                    }, 2000);
                }, 1500);
            }
        });
        
        // Contact Form
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const button = form.find('button[type="submit"]');
            
            // Simple validation
            let isValid = true;
            form.find('input[required], textarea[required], select[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });
            
            if (isValid) {
                button.html('<i class="fas fa-spinner fa-spin"></i> در حال ارسال...').prop('disabled', true);
                
                // Simulate AJAX request
                setTimeout(() => {
                    button.html('<i class="fas fa-check"></i> پیام ارسال شد!').addClass('success');
                    
                    // Reset form
                    setTimeout(() => {
                        form.trigger('reset');
                        button.html('<i class="fas fa-paper-plane"></i> ارسال درخواست مشاوره').removeClass('success').prop('disabled', false);
                    }, 2000);
                }, 2000);
            }
        });
        
        // Particles.js for hero section
        if (typeof particlesJS !== 'undefined' && $('#particles-js').length) {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80, density: { enable: true, value_area: 800 } },
                    color: { value: '#E63946' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.5, random: true },
                    size: { value: 3, random: true },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#E63946',
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: 'none',
                        random: true,
                        straight: false,
                        out_mode: 'out',
                        bounce: false
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'repulse' },
                        onclick: { enable: true, mode: 'push' }
                    }
                },
                retina_detect: true
            });
        }
        
        // Counter Animation
        function animateCounter() {
            $('.stat-number[data-count]').each(function() {
                const $this = $(this);
                const countTo = $this.data('count');
                
                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum).toLocaleString('fa-IR'));
                    },
                    complete: function() {
                        $this.text(countTo.toLocaleString('fa-IR') + '+');
                    }
                });
            });
        }
        
        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $(entry.target).addClass('animate-visible');
                    
                    if ($(entry.target).hasClass('about-stats')) {
                        animateCounter();
                    }
                }
            });
        }, { threshold: 0.1 });
        
        // Observe elements
        $('.animate-on-scroll').each(function() {
            observer.observe(this);
        });
        
        // Project Filter
        $('.filter-btn').on('click', function() {
            const filter = $(this).data('filter');
            
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            
            if (filter === 'all') {
                $('.project-card').fadeIn(300);
            } else {
                $('.project-card').each(function() {
                    if ($(this).data('category') === filter) {
                        $(this).fadeIn(300);
                    } else {
                        $(this).fadeOut(300);
                    }
                });
            }
        });
        
        // Testimonials Slider
        let testimonialIndex = 0;
        const testimonials = $('.testimonial-card');
        
        function showTestimonial(index) {
            testimonials.removeClass('active');
            $(testimonials[index]).addClass('active');
        }
        
        // Auto rotate testimonials
        setInterval(() => {
            testimonialIndex = (testimonialIndex + 1) % testimonials.length;
            showTestimonial(testimonialIndex);
        }, 5000);
        
        // Initialize
        if (testimonials.length > 0) {
            showTestimonial(0);
        }
        
        // Scroll to top on page refresh
        $(window).on('beforeunload', function() {
            $(window).scrollTop(0);
        });
        
    }); // End document ready
    
})(jQuery);