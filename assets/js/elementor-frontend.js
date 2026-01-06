/**
 * Rasa System v3.5 - Elementor Frontend JavaScript
 */

(function($) {
    'use strict';
    
    // Elementor Frontend Hooks
    $(window).on('elementor/frontend/init', function() {
        
        // Add custom handler for Rasa widgets
        elementorFrontend.hooks.addAction('frontend/element_ready/rasa_hero.default', function($scope) {
            initHeroWidget($scope);
        });
        
        elementorFrontend.hooks.addAction('frontend/element_ready/rasa_services.default', function($scope) {
            initServicesWidget($scope);
        });
        
        elementorFrontend.hooks.addAction('frontend/element_ready/rasa_products.default', function($scope) {
            initProductsWidget($scope);
        });
        
        elementorFrontend.hooks.addAction('frontend/element_ready/rasa_team.default', function($scope) {
            initTeamWidget($scope);
        });
        
        elementorFrontend.hooks.addAction('frontend/element_ready/rasa_testimonials.default', function($scope) {
            initTestimonialsWidget($scope);
        });
        
        // Initialize all custom widgets
        function initHeroWidget($scope) {
            const hero = $scope.find('.rasa-hero-widget');
            if (hero.length && window.particlesJS) {
                const id = 'hero-particles-' + Math.random().toString(36).substr(2, 9);
                hero.append('<div id="' + id + '" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;"></div>');
                
                particlesJS(id, {
                    particles: {
                        number: { value: 60, density: { enable: true, value_area: 800 } },
                        color: { value: '#E63946' },
                        shape: { type: 'circle' },
                        opacity: { value: 0.3, random: true },
                        size: { value: 2, random: true },
                        line_linked: {
                            enable: true,
                            distance: 100,
                            color: '#E63946',
                            opacity: 0.1,
                            width: 1
                        },
                        move: {
                            enable: true,
                            speed: 1.5,
                            direction: 'none',
                            random: true,
                            straight: false,
                            out_mode: 'out'
                        }
                    },
                    interactivity: {
                        detect_on: 'canvas',
                        events: {
                            onhover: { enable: true, mode: 'repulse' }
                        }
                    }
                });
            }
        }
        
        function initServicesWidget($scope) {
            const cards = $scope.find('.rasa-service-card');
            cards.each(function() {
                $(this).on('mouseenter', function() {
                    $(this).find('.rasa-service-icon').css({
                        'transform': 'scale(1.1) rotate(10deg)',
                        'transition': 'all 0.3s ease'
                    });
                }).on('mouseleave', function() {
                    $(this).find('.rasa-service-icon').css('transform', '');
                });
            });
        }
        
        function initProductsWidget($scope) {
            // Add hover effects to product cards
            $scope.find('.rasa-product-card').on('mouseenter', function() {
                $(this).css({
                    'transform': 'translateY(-10px)',
                    'box-shadow': '0 20px 40px rgba(0, 0, 0, 0.3)'
                });
            }).on('mouseleave', function() {
                $(this).css({
                    'transform': '',
                    'box-shadow': ''
                });
            });
        }
        
        function initTeamWidget($scope) {
            // Team member hover effects
            $scope.find('.rasa-team-member').on('mouseenter', function() {
                $(this).find('.member-social').fadeIn(300);
            }).on('mouseleave', function() {
                $(this).find('.member-social').fadeOut(300);
            });
        }
        
        function initTestimonialsWidget($scope) {
            // Testimonials slider
            const testimonials = $scope.find('.rasa-testimonial-card');
            if (testimonials.length > 1) {
                let currentIndex = 0;
                
                function showTestimonial(index) {
                    testimonials.removeClass('active');
                    testimonials.eq(index).addClass('active');
                }
                
                // Auto rotate
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % testimonials.length;
                    showTestimonial(currentIndex);
                }, 5000);
                
                // Initialize
                showTestimonial(0);
            }
        }
        
        // Add custom animations to Elementor elements
        elementorFrontend.hooks.addAction('frontend/element_ready/widget', function($scope) {
            // Add scroll animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('elementor-animate');
                    }
                });
            }, { threshold: 0.1 });
            
            observer.observe($scope[0]);
            
            // Add hover effects to all Elementor widgets
            $scope.find('.elementor-widget-container').each(function() {
                if ($(this).hasClass('rasa-hover-effect')) {
                    $(this).on('mouseenter', function() {
                        $(this).css({
                            'transform': 'translateY(-5px)',
                            'box-shadow': '0 15px 30px rgba(0, 0, 0, 0.2)'
                        });
                    }).on('mouseleave', function() {
                        $(this).css({
                            'transform': '',
                            'box-shadow': ''
                        });
                    });
                }
            });
        });
        
        // Fix RTL issues
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
            // Fix text alignment for RTL
            $('.elementor-widget-wrap').css('text-align', 'right');
            $('.elementor-button-wrapper').css('text-align', 'right');
            $('.elementor-heading-title').css('text-align', 'right');
            
            // Fix icon positions
            $('.elementor-icon-box-icon').css({
                'margin-left': '20px',
                'margin-right': '0'
            });
            
            // Fix form fields
            $('.elementor-field-group').css('text-align', 'right');
            $('.elementor-field-label').css('text-align', 'right');
        });
        
    });
    
    // Theme integration for Elementor
    $(document).ready(function() {
        
        // Apply theme colors to Elementor elements
        function applyThemeColors() {
            const theme = $('html').attr('data-theme') || 'dark';
            const isDark = theme === 'dark';
            
            $('.elementor-widget-container').each(function() {
                if (isDark) {
                    $(this).css({
                        'background-color': 'var(--card-bg, #1A1A1A)',
                        'color': 'var(--text-light, #FFFFFF)'
                    });
                } else {
                    $(this).css({
                        'background-color': '#FFFFFF',
                        'color': '#1E293B'
                    });
                }
            });
        }
        
        // Listen for theme changes
        $(document).on('click', '.theme-switcher', function() {
            setTimeout(applyThemeColors, 100);
        });
        
        // Apply on load
        setTimeout(applyThemeColors, 500);
        
        // Fix mobile menu conflicts
        $(document).on('click', '#hamburger', function() {
            // Close Elementor mobile menu if open
            $('.elementor-menu-toggle').removeClass('elementor-active');
            $('.elementor-nav-menu').removeClass('elementor-nav-menu--dropdown-open');
        });
        
        // Handle Elementor popups
        $(document).on('click', '.elementor-popup-modal', function() {
            // Add Rasa theme classes to popup
            setTimeout(function() {
                $('.dialog-message').addClass('rasa-theme-popup');
                $('.dialog-close-button').addClass('rasa-close-btn');
            }, 100);
        });
        
        // Counter animation for stats
        function animateCounters() {
            $('.elementor-counter-number').each(function() {
                const $this = $(this);
                const countTo = parseInt($this.text().replace(/,/g, ''));
                
                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum).toLocaleString('fa-IR'));
                    },
                    complete: function() {
                        $this.text(countTo.toLocaleString('fa-IR'));
                    }
                });
            });
        }
        
        // Observe counters when they come into view
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        $('.elementor-counter-number-wrapper').each(function() {
            counterObserver.observe(this);
        });
        
        // Enhance Elementor forms
        $('.elementor-form').on('submit', function(e) {
            const form = $(this);
            let isValid = true;
            
            form.find('input[required], textarea[required], select[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('elementor-error');
                    
                    if (!$(this).next('.elementor-error-message').length) {
                        const errorMsg = $('<div class="elementor-error-message">این فیلد الزامی است</div>');
                        $(this).after(errorMsg);
                    }
                } else {
                    $(this).removeClass('elementor-error');
                    $(this).next('.elementor-error-message').remove();
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('لطفاً فیلدهای الزامی را پر کنید', 'error');
            }
        });
        
        function showNotification(message, type = 'info') {
            const notification = $(`
                <div class="elementor-alert elementor-alert-${type}">
                    <span class="elementor-alert-title">${message}</span>
                    <button type="button" class="elementor-alert-dismiss">
                        <i class="eicon-close"></i>
                    </button>
                </div>
            `);
            
            $('body').append(notification);
            
            setTimeout(() => {
                notification.fadeIn(300);
            }, 10);
            
            setTimeout(() => {
                notification.fadeOut(300, () => {
                    notification.remove();
                });
            }, 5000);
            
            notification.find('.elementor-alert-dismiss').on('click', function() {
                notification.fadeOut(300, () => {
                    notification.remove();
                });
            });
        }
        
    });
    
})(jQuery);