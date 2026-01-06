<?php
/**
 * Rasa System v3.5 - Theme Settings Page
 * 
 * صفحه تنظیمات قالب - نسخه اصلاح شده
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Rasa_Theme_Settings {
    
    private $page_slug = 'rasa-theme-settings';
    
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }
    
    public function add_admin_menu() {
        // منوی اصلی
        add_menu_page(
            'رسا سیستم v3.5',
            'رسا سیستم v3.5',
            'manage_options',
            $this->page_slug,
            [$this, 'render_settings_page'],
            'dashicons-admin-customizer',
            61
        );
        
        // زیرمنوها
        add_submenu_page(
            $this->page_slug,
            'تنظیمات عمومی',
            'تنظیمات عمومی',
            'manage_options',
            $this->page_slug,
            [$this, 'render_settings_page']
        );
        
        add_submenu_page(
            $this->page_slug,
            'تنظیمات المنتور',
            'تنظیمات المنتور',
            'manage_options',
            'rasa-elementor-settings',
            [$this, 'render_elementor_settings']
        );
        
        add_submenu_page(
            $this->page_slug,
            'رنگ‌بندی قالب',
            'رنگ‌بندی',
            'manage_options',
            'rasa-color-settings',
            [$this, 'render_color_settings']
        );
    }
    
    public function register_settings() {
        // گروه‌های جداگانه برای هر بخش
        register_setting('rasa_general_settings', 'rasa_main_phone', 'sanitize_text_field');
        register_setting('rasa_general_settings', 'rasa_main_email', 'sanitize_email');
        register_setting('rasa_general_settings', 'rasa_main_address', 'sanitize_textarea_field');
        register_setting('rasa_general_settings', 'rasa_working_hours', 'sanitize_text_field');
        
        // تنظیمات المنتور
        register_setting('rasa_elementor_settings', 'rasa_elementor_homepage', 'absint');
        register_setting('rasa_elementor_settings', 'rasa_elementor_widgets', 'absint');
        register_setting('rasa_elementor_settings', 'rasa_elementor_styles', 'absint');
        
        // تنظیمات رنگ - با validation
        register_setting('rasa_color_settings', 'rasa_color_primary_red', [$this, 'sanitize_color']);
        register_setting('rasa_color_settings', 'rasa_color_primary_blue', [$this, 'sanitize_color']);
        register_setting('rasa_color_settings', 'rasa_color_dark_bg', [$this, 'sanitize_color']);
        register_setting('rasa_color_settings', 'rasa_color_card_bg', [$this, 'sanitize_color']);
        register_setting('rasa_color_settings', 'rasa_color_text_light', [$this, 'sanitize_color']);
        register_setting('rasa_color_settings', 'rasa_color_text_gray', [$this, 'sanitize_color']);
    }
    
    public function sanitize_color($color) {
        // بررسی و اعتبارسنجی رنگ HEX
        if (preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color)) {
            return $color;
        }
        return '#E63946'; // مقدار پیش‌فرض
    }
    
    public function render_settings_page() {
        ?>
        <div class="wrap rasa-theme-settings">
            <h1><i class="dashicons dashicons-admin-customizer"></i> تنظیمات قالب رسا سیستم v3.5</h1>
            
            <div class="rasa-settings-tabs">
                <h2 class="nav-tab-wrapper">
                    <a href="#general" class="nav-tab nav-tab-active">عمومی</a>
                    <a href="#elementor" class="nav-tab">Elementor</a>
                    <a href="#colors" class="nav-tab">رنگ‌ها</a>
                </h2>
            </div>
            
            <!-- تب عمومی -->
            <div class="rasa-tab-content active" id="general">
                <h2>تنظیمات عمومی</h2>
                <form method="post" action="options.php">
                    <?php settings_fields('rasa_general_settings'); ?>
                    <table class="form-table">
                        <tr>
                            <th><label for="rasa_main_phone">شماره تماس</label></th>
                            <td>
                                <input type="text" id="rasa_main_phone" name="rasa_main_phone" 
                                       value="<?php echo esc_attr(get_option('rasa_main_phone', '۰۹۱۲-۸۷۰-۲۱۲۴')); ?>" 
                                       class="regular-text">
                                <p class="description">شماره تماس اصلی شرکت</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_main_email">ایمیل</label></th>
                            <td>
                                <input type="email" id="rasa_main_email" name="rasa_main_email" 
                                       value="<?php echo esc_attr(get_option('rasa_main_email', 'info@rasasystemco.com')); ?>" 
                                       class="regular-text">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_main_address">آدرس</label></th>
                            <td>
                                <textarea id="rasa_main_address" name="rasa_main_address" 
                                          rows="3" class="large-text"><?php 
                                    echo esc_textarea(get_option('rasa_main_address', 'تهران، خیابان ولیعصر')); 
                                ?></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_working_hours">ساعات کاری</label></th>
                            <td>
                                <input type="text" id="rasa_working_hours" name="rasa_working_hours" 
                                       value="<?php echo esc_attr(get_option('rasa_working_hours', 'شنبه تا چهارشنبه: ۸:۰۰ - ۱۷:۰۰')); ?>" 
                                       class="regular-text">
                            </td>
                        </tr>
                    </table>
                    <?php submit_button('ذخیره تنظیمات عمومی'); ?>
                </form>
            </div>
            
            <!-- تب المنتور -->
            <div class="rasa-tab-content" id="elementor">
                <h2>تنظیمات Elementor</h2>
                <form method="post" action="options.php">
                    <?php settings_fields('rasa_elementor_settings'); ?>
                    <table class="form-table">
                        <tr>
                            <th><label for="rasa_elementor_homepage">صفحه اصلی المنتور</label></th>
                            <td>
                                <select id="rasa_elementor_homepage" name="rasa_elementor_homepage">
                                    <option value="">-- استفاده از کد قالب --</option>
                                    <?php
                                    $pages = get_pages();
                                    $selected = get_option('rasa_elementor_homepage', '');
                                    foreach ($pages as $page) {
                                        printf(
                                            '<option value="%s" %s>%s</option>',
                                            $page->ID,
                                            selected($selected, $page->ID, false),
                                            esc_html($page->post_title)
                                        );
                                    }
                                    ?>
                                </select>
                                <p class="description">صفحه‌ای که با المنتور طراحی کرده‌اید را انتخاب کنید</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_elementor_widgets">ویجت‌های سفارشی</label></th>
                            <td>
                                <label>
                                    <input type="checkbox" id="rasa_elementor_widgets" name="rasa_elementor_widgets" 
                                           value="1" <?php checked(get_option('rasa_elementor_widgets'), '1'); ?>>
                                    فعال کردن ویجت‌های اختصاصی رسا سیستم
                                </label>
                                <p class="description">ویجت‌هایی مانند: هیرو، خدمات، محصولات، تیم و ...</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_elementor_styles">استایل‌های سفارشی</label></th>
                            <td>
                                <label>
                                    <input type="checkbox" id="rasa_elementor_styles" name="rasa_elementor_styles" 
                                           value="1" <?php checked(get_option('rasa_elementor_styles'), '1'); ?>>
                                    اعمال استایل‌های قالب روی المنتور
                                </label>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <?php if (defined('ELEMENTOR_PRO_VERSION')): ?>
                                    <a href="<?php echo admin_url('edit.php?post_type=elementor_library&tabs_group=theme'); ?>" 
                                       class="button button-primary">
                                        <i class="dashicons dashicons-edit"></i> رفتن به Theme Builder
                                    </a>
                                <?php else: ?>
                                    <p class="description" style="color: #f00;">
                                        برای استفاده از Theme Builder نیاز به Elementor Pro دارید
                                    </p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button('ذخیره تنظیمات المنتور'); ?>
                </form>
            </div>
            
            <!-- تب رنگ‌ها -->
            <div class="rasa-tab-content" id="colors">
                <h2>رنگ‌بندی قالب</h2>
                <form method="post" action="options.php">
                    <?php settings_fields('rasa_color_settings'); ?>
                    <table class="form-table">
                        <tr>
                            <th><label for="rasa_color_primary_red">قرمز اصلی</label></th>
                            <td>
                                <input type="text" id="rasa_color_primary_red" name="rasa_color_primary_red" 
                                       value="<?php echo esc_attr(get_option('rasa_color_primary_red', '#E63946')); ?>" 
                                       class="color-picker" data-default-color="#E63946">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_color_primary_blue">آبی اصلی</label></th>
                            <td>
                                <input type="text" id="rasa_color_primary_blue" name="rasa_color_primary_blue" 
                                       value="<?php echo esc_attr(get_option('rasa_color_primary_blue', '#457B9D')); ?>" 
                                       class="color-picker" data-default-color="#457B9D">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_color_dark_bg">پس‌زمینه تیره</label></th>
                            <td>
                                <input type="text" id="rasa_color_dark_bg" name="rasa_color_dark_bg" 
                                       value="<?php echo esc_attr(get_option('rasa_color_dark_bg', '#121212')); ?>" 
                                       class="color-picker" data-default-color="#121212">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_color_card_bg">پس‌زمینه کارت</label></th>
                            <td>
                                <input type="text" id="rasa_color_card_bg" name="rasa_color_card_bg" 
                                       value="<?php echo esc_attr(get_option('rasa_color_card_bg', '#1A1A1A')); ?>" 
                                       class="color-picker" data-default-color="#1A1A1A">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_color_text_light">متن روشن</label></th>
                            <td>
                                <input type="text" id="rasa_color_text_light" name="rasa_color_text_light" 
                                       value="<?php echo esc_attr(get_option('rasa_color_text_light', '#FFFFFF')); ?>" 
                                       class="color-picker" data-default-color="#FFFFFF">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="rasa_color_text_gray">متن خاکستری</label></th>
                            <td>
                                <input type="text" id="rasa_color_text_gray" name="rasa_color_text_gray" 
                                       value="<?php echo esc_attr(get_option('rasa_color_text_gray', '#B0B0B0')); ?>" 
                                       class="color-picker" data-default-color="#B0B0B0">
                            </td>
                        </tr>
                    </table>
                    <?php submit_button('ذخیره رنگ‌ها'); ?>
                </form>
            </div>
        </div>
        
        <style>
        .rasa-theme-settings {
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            margin-top: 20px;
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, sans-serif;
        }
        
        .rasa-settings-tabs {
            margin: 20px 0;
        }
        
        .rasa-tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            background: #fff;
        }
        
        .rasa-tab-content.active {
            display: block;
        }
        
        .rasa-tab-content h2 {
            color: #E63946;
            border-bottom: 2px solid #E63946;
            padding-bottom: 10px;
            margin-top: 0;
        }
        
        .color-picker {
            width: 100px;
        }
        
        .form-table th {
            width: 200px;
            padding: 20px 10px 20px 0;
        }
        
        .wp-picker-container {
            vertical-align: middle;
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Tab Management
            $('.nav-tab').on('click', function(e) {
                e.preventDefault();
                
                $('.nav-tab').removeClass('nav-tab-active');
                $(this).addClass('nav-tab-active');
                
                $('.rasa-tab-content').removeClass('active');
                $($(this).attr('href')).addClass('active');
                
                // Update URL hash
                window.location.hash = $(this).attr('href');
            });
            
            // Color Picker
            $('.color-picker').wpColorPicker();
            
            // Handle hash on load
            if (window.location.hash) {
                $('a[href="' + window.location.hash + '"]').click();
            }
        });
        </script>
        <?php
    }
    
    public function render_elementor_settings() {
        ?>
        <div class="wrap">
            <h1>تنظیمات المنتور</h1>
            <p>برای تنظیمات المنتور به تب "Elementor" در صفحه تنظیمات اصلی مراجعه کنید.</p>
            <p><a href="<?php echo admin_url('admin.php?page=rasa-theme-settings#elementor'); ?>" class="button button-primary">
                <i class="dashicons dashicons-arrow-right-alt"></i> رفتن به تنظیمات المنتور
            </a></p>
        </div>
        <?php
    }
    
    public function render_color_settings() {
        ?>
        <div class="wrap">
            <h1>تنظیمات رنگ‌بندی</h1>
            <p>برای تنظیمات رنگ‌بندی به تب "رنگ‌ها" در صفحه تنظیمات اصلی مراجعه کنید.</p>
            <p><a href="<?php echo admin_url('admin.php?page=rasa-theme-settings#colors'); ?>" class="button button-primary">
                <i class="dashicons dashicons-arrow-right-alt"></i> رفتن به تنظیمات رنگ‌بندی
            </a></p>
        </div>
        <?php
    }
    
    public function enqueue_admin_scripts($hook) {
        // فقط در صفحات مربوط به قالب اجرا شود
        $pages = ['toplevel_page_rasa-theme-settings', 'rasa-system_page_rasa-elementor-settings', 'rasa-system_page_rasa-color-settings'];
        
        if (in_array($hook, $pages) || strpos($hook, 'rasa-theme-settings') !== false) {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            
            wp_enqueue_style('rasa-admin-settings', 
                get_template_directory_uri() . '/assets/css/admin-settings.css',
                [],
                '3.5'
            );
            
            wp_enqueue_script('rasa-admin-settings',
                get_template_directory_uri() . '/assets/js/admin-settings.js',
                ['jquery', 'wp-color-picker'],
                '3.5',
                true
            );
        }
    }
}

// Initialize if in admin
if (is_admin()) {
    new Rasa_Theme_Settings();
}