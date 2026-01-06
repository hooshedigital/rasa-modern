/**
 * Rasa System v3.5 - Elementor Integration
 */

(function($) {
    'use strict';
    
    class RasaElementorIntegration {
        
        constructor() {
            this.init();
        }
        
        init() {
            // Check if we're in Elementor page
            if (this.isElementorPage()) {
                this.addBodyClass();
                this.fixElementorIssues();
                this.initThemeSwitcher();
                this.initAnimations();
                this.initCustomWidgets();
            }
            
            // Always run these
            this.integrateWithTheme();
            this.handleThemeBuilder();
        }
        
        isElementorPage() {
            return document.body.classList.contains('elementor-page') || 
                   document.body.classList.contains('elementor-editor-active');
        }
        
        addBodyClass() {
            document.body.classList.add('rasa-elementor-mode');
        }
        
        fixElementorIssues() {
            // Fix RTL issues
            this.fixRTLIssues();
            
            // Fix theme colors
            this.applyThemeColors();
            
            // Fix mobile menu
            this.fixMobileMenu();
        }
        
        fixRTLIssues() {
            // Fix Elementor RTL spacing
            $('.elementor-widget-wrap').css('text-align', 'right');
            $('.elementor-icon-box-wrapper').css('text-align', 'right');
            $('.elementor-image-box-wrapper').css('text-align', 'right');
            
            // Fix button alignment
            $('.elementor-button-wrapper').css('text-align', 'right');
        }
        
        applyThemeColors() {
            // Apply CSS variables to Elementor elements
            const colors = window.rasaElementor?.colors || {};
            
            if (colors.primary_red) {
                $('.elementor-button').each(function() {
                    if ($(this).css('background-color') === 'rgb(37, 154, 232)') { // Default blue
                        $(this).css('background-color', colors.primary_red);
                    }
                });
            }
        }
        
        fixMobileMenu() {
            // Fix Elementor mobile menu with Rasa theme
            $(document).on('click', '.elementor-menu-toggle', function() {
                $('body').toggleClass('elementor-menu-active');
            });
        }
        
        initThemeSwitcher() {
            // Make theme switcher work with Elementor
            $(document).on('click', '.theme-switcher', function() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                // Update theme
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                // Update Elementor elements
                this.updateElementorTheme(newTheme);
            }.bind(this));
        }
        
        updateElementorTheme(theme) {
            // Update Elementor widgets based on theme
            const isDark = theme === 'dark';
            
            $('.elementor-widget-container').each(function() {
                if (isDark) {
                    $(this).css({
                        'background-color': 'var(--card-bg)',
                        'color': 'var(--text-light)'
                    });
                } else {
                    $(this).css({
                        'background-color': '#FFFFFF',
                        'color': '#1E293B'
                    });
                }
            });
        }
        
        initAnimations() {
            // Add Rasa animations to Elementor elements
            this.addScrollAnimations();
            this.addHoverEffects();
        }
        
        addScrollAnimations() {
            // Add scroll animations to Elementor widgets
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $(entry.target).addClass('rasa-animate-visible');
                    }
                });
            }, { threshold: 0.1 });
            
            $('.elementor-element').each(function() {
                if (!$(this).hasClass('elementor-section')) {
                    $(this).addClass('rasa-animate');
                    observer.observe(this);
                }
            });
        }
        
        addHoverEffects() {
            // Add 3D hover effects to cards
            $('.elementor-widget-container').on('mouseenter', function() {
                if ($(this).hasClass('rasa-hover-3d')) {
                    $(this).css({
                        'transform': 'perspective(1000px) rotateX(5deg) rotateY(-5deg) translateZ(20px)',
                        'transition': 'transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)'
                    });
                }
            }).on('mouseleave', function() {
                $(this).css('transform', '');
            });
        }
        
        initCustomWidgets() {
            // Initialize Rasa custom widgets
            this.initHeroWidget();
            this.initServicesWidget();
            this.initStatsWidget();
        }
        
        initHeroWidget() {
            $('.rasa-hero-widget').each(function() {
                // Add particles effect
                if (window.particlesJS) {
                    particlesJS('hero-particles', {
                        particles: {
                            number: { value: 80 },
                            color: { value: '#E63946' },
                            opacity: { value: 0.5 },
                            size: { value: 3 },
                            move: { enable: true }
                        }
                    });
                }
                
                // Add typewriter effect
                const title = $(this).find('.rasa-hero-title');
                if (title.length) {
                    this.typewriterEffect(title[0]);
                }
            });
        }
        
        typewriterEffect(element) {
            const text = element.textContent;
            element.textContent = '';
            
            let i = 0;
            const type = () => {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, 50 + Math.random() * 50);
                }
            };
            
            setTimeout(type, 500);
        }
        
        initServicesWidget() {
            $('.rasa-service-card').on('mouseenter', function() {
                const icon = $(this).find('.rasa-service-icon');
                icon.css({
                    'transform': 'scale(1.2) rotate(15deg)',
                    'transition': 'all 0.3s ease'
                });
            }).on('mouseleave', function() {
                $(this).find('.rasa-service-icon').css('transform', '');
            });
        }
        
        initStatsWidget() {
            $('.rasa-stat-number').each(function() {
                const finalValue = parseInt($(this).data('count') || $(this).text());
                const duration = 2000;
                const steps = 60;
                const increment = finalValue / steps;
                let current = 0;
                
                const counter = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        clearInterval(counter);
                        $(this).text(finalValue.toLocaleString('fa-IR') + '+');
                    } else {
                        $(this).text(Math.floor(current).toLocaleString('fa-IR') + '+');
                    }
                }, duration / steps);
            });
        }
        
        integrateWithTheme() {
            // Integrate Elementor with Rasa theme features
            
            // Theme switcher integration
            this.integrateThemeSwitcher();
            
            // Mobile menu integration
            this.integrateMobileMenu();
            
            // Form validation integration
            this.integrateForms();
        }
        
        integrateThemeSwitcher() {
            // Sync Elementor with theme switcher
            $(document).on('themeChanged', (e) => {
                const theme = e.detail.theme;
                this.updateElementorTheme(theme);
            });
        }
        
        integrateMobileMenu() {
            // Close Elementor mobile menu when Rasa menu opens
            $(document).on('click', '#hamburger', function() {
                $('.elementor-menu-toggle').removeClass('elementor-active');
                $('.elementor-menu-toggle').attr('aria-expanded', 'false');
                $('.elementor-nav-menu').removeClass('elementor-nav-menu--dropdown-open');
            });
        }
        
        integrateForms() {
            // Add Rasa validation to Elementor forms
            $(document).on('submit', '.elementor-form', function(e) {
                const form = $(this);
                let isValid = true;
                
                form.find('input[required], textarea[required]').each(function() {
                    if (!$(this).val().trim()) {
                        isValid = false;
                        $(this).addClass('rasa-error');
                        
                        // Add error message
                        if (!$(this).next('.rasa-error-message').length) {
                            $(this).after('<div class="rasa-error-message">این فیلد الزامی است</div>');
                        }
                    } else {
                        $(this).removeClass('rasa-error');
                        $(this).next('.rasa-error-message').remove();
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    this.showNotification('لطفاً فیلدهای الزامی را پر کنید', 'error');
                }
            });
        }
        
        handleThemeBuilder() {
            // Handle Elementor Theme Builder
            
            // Check if we're in Theme Builder
            if ($('.elementor-theme-builder-content-area').length) {
                this.themeBuilderMode();
            }
        }
        
        themeBuilderMode() {
            // Add theme builder specific functionality
            
            // Show theme preview
            this.addThemePreview();
            
            // Add template controls
            this.addTemplateControls();
        }
        
        addThemePreview() {
            // Add theme preview switcher in Theme Builder
            if ($('#elementor-panel').length) {
                const themeSwitcher = `
                    <div class="elementor-panel-box">
                        <div class="elementor-panel-box-title">پیش‌نمایش تم</div>
                        <div class="elementor-panel-box-content">
                            <button class="elementor-button theme-preview-btn" data-theme="dark">تیره</button>
                            <button class="elementor-button theme-preview-btn" data-theme="light">روشن</button>
                        </div>
                    </div>
                `;
                
                $('#elementor-panel-page-menu').append(themeSwitcher);
                
                $('.theme-preview-btn').on('click', function() {
                    const theme = $(this).data('theme');
                    document.documentElement.setAttribute('data-theme', theme);
                });
            }
        }
        
        addTemplateControls() {
            // Add Rasa template controls to Theme Builder
            if (typeof elementor !== 'undefined' && elementor.hooks) {
                elementor.hooks.addFilter('panel/elements/views', (views) => {
                    views.rasaTemplates = {
                        title: 'تمپلیت‌های رسا',
                        view: 'rasaTemplates',
                        icon: 'eicon-custom',
                        show: () => true
                    };
                    return views;
                });
            }
        }
        
        showNotification(message, type = 'info') {
            // Show notification
            const notification = $(`
                <div class="rasa-notification rasa-notification-${type}">
                    <div class="rasa-notification-content">
                        <i class="fas fa-${type === 'success' ? 'check' : 
                                         type === 'error' ? 'exclamation' : 
                                         type === 'warning' ? 'exclamation-triangle' : 
                                         'info'}-circle"></i>
                        <span>${message}</span>
                    </div>
                    <button class="rasa-notification-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            
            $('body').append(notification);
            
            // Show animation
            setTimeout(() => notification.addClass('show'), 10);
            
            // Auto remove
            setTimeout(() => {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
            
            // Close button
            notification.find('.rasa-notification-close').on('click', () => {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            });
        }
    }
    
    // Initialize when DOM is ready
    $(document).ready(() => {
        window.rasaElementorIntegration = new RasaElementorIntegration();
    });
    
})(jQuery);