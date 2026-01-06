/**
 * Rasa System v3.5 - Elementor Editor JavaScript
 */

(function($) {
    'use strict';
    
    // Wait for Elementor to be ready
    $(window).on('elementor:init', function() {
        
        // Add Rasa custom controls
        elementor.addControlView('Rasa_Color_Picker', elementor.modules.controls.Color.extend({
            onReady: function() {
                elementor.modules.controls.Color.prototype.onReady.apply(this, arguments);
                
                // Custom styling for color picker
                this.ui.colorPicker.css({
                    'border-radius': '8px',
                    'border': '2px solid #ddd'
                });
                
                this.ui.colorPicker.on('change', function() {
                    $(this).css('border-color', '#E63946');
                });
            }
        }));
        
        // Add custom section for Rasa widgets
        elementor.addPanelPage({
            title: 'تنظیمات رسا',
            page: {
                title: 'تنظیمات رسا سیستم',
                sections: {
                    rasa_general: {
                        title: 'تنظیمات عمومی',
                        fields: {
                            primary_color: {
                                label: 'رنگ اصلی',
                                type: 'color',
                                default: '#E63946'
                            },
                            dark_mode: {
                                label: 'حالت تاریک',
                                type: 'switcher',
                                default: 'yes'
                            }
                        }
                    },
                    rasa_typography: {
                        title: 'تایپوگرافی',
                        fields: {
                            font_family: {
                                label: 'فونت اصلی',
                                type: 'select',
                                options: {
                                    'Vazirmatn': 'وزیرمتن',
                                    'Tahoma': 'تهما',
                                    'Arial': 'آریال'
                                },
                                default: 'Vazirmatn'
                            },
                            font_size: {
                                label: 'سایز فونت',
                                type: 'slider',
                                default: 16,
                                min: 12,
                                max: 24,
                                step: 1
                            }
                        }
                    }
                }
            }
        });
        
        // Add custom widget icons
        elementor.hooks.addFilter('elementor/editor/icon', function(icon, widgetName) {
            if (widgetName.startsWith('rasa_')) {
                // Custom icons for Rasa widgets
                const widgetIcons = {
                    'rasa_hero': 'eicon-banner',
                    'rasa_services': 'eicon-icon-box',
                    'rasa_products': 'eicon-products',
                    'rasa_team': 'eicon-person',
                    'rasa_testimonials': 'eicon-testimonial',
                    'rasa_contact': 'eicon-form-horizontal',
                    'rasa_clients': 'eicon-carousel',
                    'rasa_stats': 'eicon-counter',
                    'rasa_pricing': 'eicon-price-table',
                    'rasa_blog': 'eicon-posts-grid'
                };
                
                return widgetIcons[widgetName] || icon;
            }
            
            return icon;
        });
        
        // Add custom styling to editor
        elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
            // Add Rasa badge to custom widgets
            if (model.get('widgetType').startsWith('rasa_')) {
                const $widgetHeader = panel.$el.find('.elementor-panel-category-items .elementor-element');
                $widgetHeader.addClass('rasa-widget');
                
                // Add badge
                if (!$widgetHeader.find('.rasa-badge').length) {
                    $widgetHeader.append('<span class="rasa-badge">رسا</span>');
                }
            }
        });
        
        // Preview theme changes in editor
        elementor.settings.page.model.on('change', function(model) {
            if (model.changed.rasa_dark_mode !== undefined) {
                const isDark = model.changed.rasa_dark_mode === 'yes';
                $('html').attr('data-theme', isDark ? 'dark' : 'light');
            }
            
            if (model.changed.rasa_primary_color) {
                document.documentElement.style.setProperty('--primary-red', model.changed.rasa_primary_color);
            }
        });
        
        // Add custom CSS to editor
        const style = document.createElement('style');
        style.textContent = `
            .rasa-widget {
                position: relative;
                border: 2px solid rgba(229, 57, 70, 0.1) !important;
                border-radius: 8px !important;
            }
            
            .rasa-widget:hover {
                border-color: #E63946 !important;
                box-shadow: 0 5px 15px rgba(229, 57, 70, 0.1) !important;
            }
            
            .rasa-badge {
                position: absolute;
                top: 5px;
                left: 5px;
                background: #E63946;
                color: white;
                font-size: 10px;
                padding: 2px 8px;
                border-radius: 10px;
                font-weight: bold;
            }
            
            .elementor-panel-category-rasa-elements .elementor-panel-category-title {
                color: #E63946 !important;
                font-weight: 700 !important;
            }
            
            [data-theme="dark"] .elementor-editor-preview {
                background: #121212 !important;
            }
            
            [data-theme="light"] .elementor-editor-preview {
                background: #FFFFFF !important;
            }
        `;
        document.head.appendChild(style);
        
        // RTL fixes for editor
        elementor.hooks.addAction('editor/destroy', function() {
            // Fix RTL text alignment
            $('.elementor-control-content .elementor-control-title').css('text-align', 'right');
            $('.elementor-control-typography .elementor-control-title').css('text-align', 'right');
            
            // Fix icon positions
            $('.elementor-control-icon .elementor-control-title').css({
                'margin-right': '0',
                'margin-left': '10px'
            });
        });
        
        // Add custom widget preview
        elementor.hooks.addAction('panel/open_editor/widget/rasa_hero', function(panel, model, view) {
            // Custom preview for hero widget
            const preview = panel.$el.find('.elementor-panel-controls');
            if (preview.length && !preview.find('.rasa-hero-preview').length) {
                preview.append(`
                    <div class="rasa-hero-preview" style="
                        background: linear-gradient(135deg, var(--primary-red, #E63946), #121212);
                        border-radius: 10px;
                        padding: 20px;
                        margin: 15px 0;
                        color: white;
                        text-align: center;
                    ">
                        <h4 style="margin: 0 0 10px 0;">پیش‌نمایش هیرو</h4>
                        <p style="margin: 0; font-size: 12px;">ویجت هیرو رسا سیستم</p>
                    </div>
                `);
            }
        });
        
        // Initialize theme in editor
        setTimeout(() => {
            const isDark = elementor.settings.page.model.get('rasa_dark_mode') === 'yes';
            $('html').attr('data-theme', isDark ? 'dark' : 'light');
            
            const primaryColor = elementor.settings.page.model.get('rasa_primary_color') || '#E63946';
            document.documentElement.style.setProperty('--primary-red', primaryColor);
        }, 1000);
        
    });
    
    // Add custom controls when DOM is ready
    $(document).ready(function() {
        
        // Add Rasa theme switcher to Elementor panel
        setTimeout(() => {
            if ($('#elementor-panel').length) {
                // Add theme switcher button
                const themeSwitcher = `
                    <div id="rasa-theme-switcher" style="
                        position: fixed;
                        bottom: 20px;
                        left: 20px;
                        z-index: 9999;
                        background: #E63946;
                        color: white;
                        padding: 10px 15px;
                        border-radius: 20px;
                        cursor: pointer;
                        font-family: 'Vazirmatn', sans-serif;
                        font-size: 12px;
                        box-shadow: 0 3px 10px rgba(229, 57, 70, 0.3);
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    ">
                        <i class="eicon-paint-brush"></i>
                        <span>تغییر تم</span>
                    </div>
                `;
                
                $('body').append(themeSwitcher);
                
                $('#rasa-theme-switcher').on('click', function() {
                    const currentTheme = $('html').attr('data-theme') || 'dark';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    $('html').attr('data-theme', newTheme);
                    
                    // Update Elementor preview
                    elementor.settings.page.model.set('rasa_dark_mode', newTheme === 'dark' ? 'yes' : 'no');
                });
            }
        }, 2000);
        
    });
    
})(jQuery);