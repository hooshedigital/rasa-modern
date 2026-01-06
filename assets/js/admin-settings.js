/**
 * Rasa System v3.5 - Admin Settings JavaScript
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Tab Management
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            // Update active tab
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            // Show corresponding content
            const tabId = $(this).attr('href');
            $('.rasa-tab-content').removeClass('active');
            $(tabId).addClass('active');
            
            // Update URL hash
            window.location.hash = tabId;
            
            // Save active tab in localStorage
            localStorage.setItem('rasa_active_tab', tabId);
        });
        
        // Load saved tab from localStorage
        const savedTab = localStorage.getItem('rasa_active_tab') || window.location.hash;
        if (savedTab) {
            $(`a[href="${savedTab}"]`).click();
        }
        
        // Handle hash on page load
        if (window.location.hash) {
            $(`a[href="${window.location.hash}"]`).click();
        }
        
        // Color Picker
        $('.color-picker').wpColorPicker({
            defaultColor: $(this).data('default-color'),
            change: function(event, ui) {
                // Preview color change
                const color = ui.color.toString();
                const variable = $(this).attr('id').replace('rasa_color_', '').replace(/_/g, '-');
                
                // Update preview
                $('html').css(`--${variable}`, color);
                
                // Save preview in localStorage
                const colors = JSON.parse(localStorage.getItem('rasa_colors') || '{}');
                colors[variable] = color;
                localStorage.setItem('rasa_colors', JSON.stringify(colors));
            },
            clear: function() {
                const variable = $(this).attr('id').replace('rasa_color_', '').replace(/_/g, '-');
                const defaultColor = $(this).data('default-color');
                
                $('html').css(`--${variable}`, defaultColor);
                
                // Remove from localStorage
                const colors = JSON.parse(localStorage.getItem('rasa_colors') || '{}');
                delete colors[variable];
                localStorage.setItem('rasa_colors', JSON.stringify(colors));
            }
        });
        
        // Load saved colors from localStorage
        const savedColors = JSON.parse(localStorage.getItem('rasa_colors') || '{}');
        Object.keys(savedColors).forEach(variable => {
            $('html').css(`--${variable}`, savedColors[variable]);
        });
        
        // Form validation
        $('form').on('submit', function(e) {
            let isValid = true;
            
            // Validate required fields
            $(this).find('input[required], textarea[required], select[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('error');
                    
                    // Add error message
                    if (!$(this).next('.error-message').length) {
                        $(this).after('<div class="error-message" style="color: #dc3545; font-size: 12px; margin-top: 5px;">این فیلد الزامی است</div>');
                    }
                } else {
                    $(this).removeClass('error');
                    $(this).next('.error-message').remove();
                }
            });
            
            // Validate email fields
            $(this).find('input[type="email"]').each(function() {
                const email = $(this).val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    isValid = false;
                    $(this).addClass('error');
                    
                    if (!$(this).next('.error-message').length) {
                        $(this).after('<div class="error-message" style="color: #dc3545; font-size: 12px; margin-top: 5px;">ایمیل معتبر نیست</div>');
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('لطفاً فیلدهای قرمز رنگ را اصلاح کنید', 'error');
                return false;
            }
            
            // Show success message
            showNotification('تنظیمات با موفقیت ذخیره شد', 'success');
        });
        
        // Show/hide fields based on selections
        $('#rasa_elementor_widgets').on('change', function() {
            if ($(this).is(':checked')) {
                $('.elementor-widgets-options').slideDown();
            } else {
                $('.elementor-widgets-options').slideUp();
            }
        });
        
        // Preview theme colors
        $('#preview-theme').on('click', function(e) {
            e.preventDefault();
            
            // Collect all color values
            const colors = {
                'primary-red': $('#rasa_color_primary_red').val(),
                'primary-blue': $('#rasa_color_primary_blue').val(),
                'dark-bg': $('#rasa_color_dark_bg').val(),
                'card-bg': $('#rasa_color_card_bg').val(),
                'text-light': $('#rasa_color_text_light').val(),
                'text-gray': $('#rasa_color_text_gray').val()
            };
            
            // Apply to preview iframe
            applyColorsToPreview(colors);
            
            showNotification('پیش‌نمایش رنگ‌ها اعمال شد', 'info');
        });
        
        // Reset to defaults
        $('#reset-colors').on('click', function(e) {
            e.preventDefault();
            
            if (confirm('آیا مطمئن هستید که می‌خواهید همه رنگ‌ها به حالت پیش‌فرض بازگردند؟')) {
                // Reset all color pickers to defaults
                $('.color-picker').each(function() {
                    const defaultColor = $(this).data('default-color');
                    $(this).wpColorPicker('color', defaultColor);
                });
                
                // Clear localStorage
                localStorage.removeItem('rasa_colors');
                
                showNotification('رنگ‌ها به حالت پیش‌فرض بازگشتند', 'success');
            }
        });
        
        // Export/Import settings
        $('#export-settings').on('click', function(e) {
            e.preventDefault();
            
            const settings = {
                general: {
                    phone: $('#rasa_main_phone').val(),
                    email: $('#rasa_main_email').val(),
                    address: $('#rasa_main_address').val(),
                    hours: $('#rasa_working_hours').val()
                },
                elementor: {
                    homepage: $('#rasa_elementor_homepage').val(),
                    widgets: $('#rasa_elementor_widgets').is(':checked'),
                    styles: $('#rasa_elementor_styles').is(':checked')
                },
                colors: {}
            };
            
            // Collect colors
            $('.color-picker').each(function() {
                const id = $(this).attr('id').replace('rasa_color_', '');
                settings.colors[id] = $(this).val();
            });
            
            // Create download link
            const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(settings, null, 2));
            const downloadAnchor = document.createElement('a');
            downloadAnchor.setAttribute("href", dataStr);
            downloadAnchor.setAttribute("download", "rasa-settings-" + new Date().toISOString().slice(0,10) + ".json");
            document.body.appendChild(downloadAnchor);
            downloadAnchor.click();
            document.body.removeChild(downloadAnchor);
            
            showNotification('تنظیمات با موفقیت صادر شد', 'success');
        });
        
        $('#import-settings').on('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const settings = JSON.parse(e.target.result);
                    
                    // Apply settings
                    if (settings.general) {
                        $('#rasa_main_phone').val(settings.general.phone || '');
                        $('#rasa_main_email').val(settings.general.email || '');
                        $('#rasa_main_address').val(settings.general.address || '');
                        $('#rasa_working_hours').val(settings.general.hours || '');
                    }
                    
                    if (settings.elementor) {
                        $('#rasa_elementor_homepage').val(settings.elementor.homepage || '');
                        $('#rasa_elementor_widgets').prop('checked', settings.elementor.widgets);
                        $('#rasa_elementor_styles').prop('checked', settings.elementor.styles);
                    }
                    
                    if (settings.colors) {
                        Object.keys(settings.colors).forEach(key => {
                            $(`#rasa_color_${key}`).wpColorPicker('color', settings.colors[key]);
                        });
                    }
                    
                    showNotification('تنظیمات با موفقیت وارد شد', 'success');
                } catch (error) {
                    showNotification('خطا در وارد کردن فایل', 'error');
                }
            };
            reader.readAsText(file);
            
            // Reset file input
            $(this).val('');
        });
        
        // Helper functions
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            $('.rasa-notification').remove();
            
            const notification = $(`
                <div class="rasa-notification rasa-notification-${type}">
                    <div class="rasa-notification-content">
                        <i class="fas fa-${getNotificationIcon(type)}"></i>
                        <span>${message}</span>
                    </div>
                    <button class="rasa-notification-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            
            $('.wrap').prepend(notification);
            
            // Show animation
            setTimeout(() => notification.addClass('show'), 10);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
            
            // Close button
            notification.find('.rasa-notification-close').on('click', function() {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            });
        }
        
        function getNotificationIcon(type) {
            switch(type) {
                case 'success': return 'check-circle';
                case 'error': return 'exclamation-circle';
                case 'warning': return 'exclamation-triangle';
                default: return 'info-circle';
            }
        }
        
        function applyColorsToPreview(colors) {
            // This would typically apply to an iframe preview
            // For now, just update the current page
            Object.keys(colors).forEach(variable => {
                document.documentElement.style.setProperty(`--${variable}`, colors[variable]);
            });
        }
        
        // Initialize
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                $(`a[href="${window.location.hash}"]`).click();
            }
        });
        
    });
    
})(jQuery);