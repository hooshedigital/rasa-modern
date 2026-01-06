<?php
/**
 * Rasa System Modern v3.5
 * Theme Functions - نسخه بهینه شده
 * 
 * این فایل قابلیت‌های اصلی قالب را پیاده‌سازی می‌کند
 * Version: 3.5
 * Author: پارسا فانی و خشایار بهمنش
 */

if (!defined('ABSPATH')) {
    exit;
}

// ========== تعریف ثابت‌ها ==========
define('RASA_VERSION', '3.5');
define('RASA_THEME_NAME', 'Rasa System Modern');
define('RASA_DIR', get_template_directory());
define('RASA_URI', get_template_directory_uri());
define('RASA_INC_DIR', RASA_DIR . '/inc');
define('RASA_ASSETS_DIR', RASA_DIR . '/assets');
define('RASA_ASSETS_URI', RASA_URI . '/assets');
define('RASA_CSS_DIR', RASA_ASSETS_DIR . '/css');
define('RASA_JS_DIR', RASA_ASSETS_DIR . '/js');

// ========== راه‌اندازی اولیه قالب ==========
add_action('after_setup_theme', 'rasa_theme_setup');
function rasa_theme_setup() {
    // پشتیبانی از ترجمه
    load_theme_textdomain('rasa-system', RASA_DIR . '/languages');
    
    // عنوان داینامیک
    add_theme_support('title-tag');
    
    // تصویر شاخص
    add_theme_support('post-thumbnails');
    
    // HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    
    // RSS feeds
    add_theme_support('automatic-feed-links');
    
    // ویدجت‌ها
    add_theme_support('widgets');
    
    // المنتور
    add_theme_support('elementor');
    
    // لوگو سفارشی
    add_theme_support('custom-logo', [
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    
    // اندازه‌های تصویر سفارشی
    add_image_size('rasa-large', 1200, 600, true);
    add_image_size('rasa-medium', 600, 400, true);
    add_image_size('rasa-team', 400, 400, true);
    add_image_size('rasa-blog', 800, 450, true);
    
    // منوها
    register_nav_menus([
        'primary' => __('منوی اصلی', 'rasa-system'),
        'footer' => __('منوی فوتر', 'rasa-system'),
        'mobile' => __('منوی موبایل', 'rasa-system'),
    ]);
    
    // پشتیبانی از align-wide
    add_theme_support('align-wide');
    
    // رنگ‌های داینامیک
    add_theme_support('editor-color-palette', [
        ['name' => 'قرمز اصلی', 'slug' => 'primary-red', 'color' => '#E63946'],
        ['name' => 'آبی اصلی', 'slug' => 'primary-blue', 'color' => '#457B9D'],
        ['name' => 'پس‌زمینه تیره', 'slug' => 'dark-bg', 'color' => '#121212'],
        ['name' => 'متن روشن', 'slug' => 'text-light', 'color' => '#FFFFFF'],
    ]);
}

// ========== استایل‌ها و اسکریپت‌ها ==========
add_action('wp_enqueue_scripts', 'rasa_enqueue_assets');
function rasa_enqueue_assets() {
    // 1. jQuery
    wp_enqueue_script('jquery');
    
    // 2. فونت‌ها
    wp_enqueue_style('vazirmatn-font', 'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css', [], null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', [], '6.5.1');
    
    // 3. استایل اصلی وردپرس
    wp_enqueue_style('rasa-style', get_stylesheet_uri(), ['vazirmatn-font', 'font-awesome'], RASA_VERSION);
    
    // 4. main.css
    $main_css = RASA_CSS_DIR . '/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style('rasa-main', RASA_ASSETS_URI . '/css/main.css', [], filemtime($main_css));
    }
    
    // 5. responsive.css
    $responsive_css = RASA_CSS_DIR . '/responsive.css';
    if (file_exists($responsive_css)) {
        wp_enqueue_style('rasa-responsive', RASA_ASSETS_URI . '/css/responsive.css', ['rasa-main'], filemtime($responsive_css));
    }
    
    // 6. اسکریپت اصلی
    $main_js = RASA_JS_DIR . '/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script('rasa-main', RASA_ASSETS_URI . '/js/main.js', ['jquery'], filemtime($main_js), true);
        
        wp_localize_script('rasa-main', 'rasa_theme', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('rasa_ajax_nonce'),
            'home_url' => home_url('/'),
            'is_front_page' => is_front_page(),
            'contact_phone' => get_option('rasa_main_phone', '۰۹۱۲-۸۷۰-۲۱۲۴'),
            'contact_email' => get_option('rasa_main_email', 'info@rasasystemco.com'),
        ]);
    }
}

// ========== ویدجت‌ها ==========
add_action('widgets_init', 'rasa_register_widgets');
function rasa_register_widgets() {
    // سایدبار اصلی
    register_sidebar([
        'name' => __('سایدبار اصلی', 'rasa-system'),
        'id' => 'main-sidebar',
        'description' => __('ویجت‌های سایدبار اصلی', 'rasa-system'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ]);
    
    // فوتر
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar([
            'name' => sprintf(__('فوتر - ستون %d', 'rasa-system'), $i),
            'id' => 'footer-' . $i,
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title"><span>',
            'after_title' => '</span></h4>',
        ]);
    }
}

// ========== المنتور ==========
add_action('elementor/init', 'rasa_elementor_init');
function rasa_elementor_init() {
    if (defined('ELEMENTOR_VERSION')) {
        add_action('elementor/widgets/register', 'rasa_register_elementor_widgets');
        add_action('elementor/elements/categories_registered', 'rasa_add_elementor_category');
    }
}

function rasa_register_elementor_widgets($widgets_manager) {
    // بارگذاری ویجت‌های المنتور اگر وجود دارند
    $widgets_dir = RASA_DIR . '/elementor-widgets/';
    
    if (file_exists($widgets_dir)) {
        $widget_files = glob($widgets_dir . 'class-*.php');
        
        foreach ($widget_files as $file) {
            require_once $file;
            
            $class_name = 'Rasa_' . str_replace(['class-', '-widget.php'], '', basename($file));
            $class_name = str_replace('-', '_', $class_name);
            $class_name = ucwords($class_name, '_');
            $class_name = str_replace(' ', '_', $class_name);
            
            if (class_exists($class_name)) {
                $widgets_manager->register(new $class_name());
            }
        }
    }
}

function rasa_add_elementor_category($elements_manager) {
    $elements_manager->add_category('rasa-elements', [
        'title' => 'رسا سیستم',
        'icon' => 'eicon-custom',
    ]);
}

// ========== هوک‌ها و فیلترها ==========
add_filter('body_class', 'rasa_body_classes');
function rasa_body_classes($classes) {
    // المنتور
    if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID())) {
        $classes[] = 'rasa-elementor-page';
    }
    
    // ریسپانسیو
    $classes[] = 'rasa-responsive';
    
    return $classes;
}

// ========== آپشن‌های قالب ==========
require_once RASA_DIR . '/theme-settings.php';

// ========== فعال‌سازی قالب ==========
register_activation_hook(__FILE__, 'rasa_theme_activation');
function rasa_theme_activation() {
    update_option('rasa_theme_version', RASA_VERSION);
    
    $defaults = [
        'rasa_main_phone' => '۰۹۱۲-۸۷۰-۲۱۲۴',
        'rasa_main_email' => 'info@rasasystemco.com',
        'rasa_main_address' => 'تهران، خیابان ولیعصر',
        'rasa_working_hours' => 'شنبه تا چهارشنبه: ۸:۰۰ - ۱۷:۰۰',
        'rasa_color_primary_red' => '#E63946',
        'rasa_color_primary_blue' => '#457B9D',
        'rasa_color_dark_bg' => '#121212',
        'rasa_color_text_light' => '#FFFFFF',
    ];
    
    foreach ($defaults as $key => $value) {
        if (!get_option($key)) {
            update_option($key, $value);
        }
    }
}

// ========== AJAX هندلرها ==========
add_action('wp_ajax_rasa_contact_form', 'rasa_ajax_contact_form');
add_action('wp_ajax_nopriv_rasa_contact_form', 'rasa_ajax_contact_form');
function rasa_ajax_contact_form() {
    if (!wp_verify_nonce($_POST['nonce'], 'rasa_ajax_nonce')) {
        wp_send_json_error('خطای امنیتی!');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);
    
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('لطفاً فیلدهای ضروری را پر کنید.');
    }
    
    $to = get_option('rasa_main_email', 'info@rasasystemco.com');
    $subject = 'پیام جدید از فرم تماس - ' . get_bloginfo('name');
    
    $body = "نام: $name\n";
    $body .= "ایمیل: $email\n";
    $body .= "پیام:\n$message\n\n";
    $body .= "آدرس: " . home_url('/') . "\n";
    $body .= "تاریخ: " . current_time('Y/m/d H:i:s') . "\n";
    
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    
    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success('پیام شما با موفقیت ارسال شد.');
    } else {
        wp_send_json_error('خطا در ارسال پیام.');
    }
}

// ========== کدهای داینامیک CSS ==========
add_action('wp_head', 'rasa_dynamic_styles');
function rasa_dynamic_styles() {
    ?>
    <style id="rasa-dynamic-colors">
    :root {
        --primary-red: <?php echo esc_attr(get_option('rasa_color_primary_red', '#E63946')); ?>;
        --primary-blue: <?php echo esc_attr(get_option('rasa_color_primary_blue', '#457B9D')); ?>;
        --dark-bg: <?php echo esc_attr(get_option('rasa_color_dark_bg', '#121212')); ?>;
        --text-light: <?php echo esc_attr(get_option('rasa_color_text_light', '#FFFFFF')); ?>;
    }
    
    /* حالت روشن */
    [data-theme="light"] {
        --dark-bg: #FFFFFF;
        --text-light: #1E293B;
    }
    
    /* حالت تیره */
    [data-theme="dark"] {
        --dark-bg: #0F172A;
        --text-light: #F1F5F9;
    }
    </style>
    <?php
}

// ========== واتس‌اپ ==========
add_action('wp_footer', 'rasa_whatsapp_button');
function rasa_whatsapp_button() {
    $whatsapp_number = get_option('rasa_main_phone', '09128702124');
    $whatsapp_number = preg_replace('/[^0-9]/', '', $whatsapp_number);
    
    if (empty($whatsapp_number)) {
        $whatsapp_number = '09128702124';
    }
    ?>
    <a href="https://wa.me/<?php echo $whatsapp_number; ?>" 
       class="whatsapp-float" 
       target="_blank" 
       rel="noopener" 
       aria-label="واتس‌اپ">
        <i class="fab fa-whatsapp"></i>
    </a>
    
    <style>
    .whatsapp-float {
        position: fixed;
        bottom: 25px;
        <?php echo is_rtl() ? 'left: 25px;' : 'right: 25px;'; ?>
        width: 60px;
        height: 60px;
        background: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
    }
    
    .whatsapp-float:hover {
        background: #128C7E;
        transform: scale(1.1);
    }
    
    .whatsapp-float i {
        color: white;
        font-size: 30px;
    }
    
    @media (max-width: 768px) {
        .whatsapp-float {
            width: 50px;
            height: 50px;
            bottom: 20px;
            <?php echo is_rtl() ? 'left: 20px;' : 'right: 20px;'; ?>
        }
        
        .whatsapp-float i {
            font-size: 25px;
        }
    }
    </style>
    <?php
}

// ========== shortcode برای اطلاعات تماس ==========
add_shortcode('rasa_contact_info', 'rasa_contact_info_shortcode');
function rasa_contact_info_shortcode($atts) {
    $atts = shortcode_atts([
        'type' => 'all',
    ], $atts);
    
    $output = '<div class="rasa-contact-info">';
    
    if ($atts['type'] === 'all' || $atts['type'] === 'phone') {
        $phone = get_option('rasa_main_phone', '۰۹۱۲-۸۷۰-۲۱۲۴');
        $output .= '<div class="contact-item"><i class="fas fa-phone"></i> ' . esc_html($phone) . '</div>';
    }
    
    if ($atts['type'] === 'all' || $atts['type'] === 'email') {
        $email = get_option('rasa_main_email', 'info@rasasystemco.com');
        $output .= '<div class="contact-item"><i class="fas fa-envelope"></i> ' . esc_html($email) . '</div>';
    }
    
    if ($atts['type'] === 'all' || $atts['type'] === 'address') {
        $address = get_option('rasa_main_address', 'تهران، خیابان ولیعصر');
        $output .= '<div class="contact-item"><i class="fas fa-map-marker-alt"></i> ' . esc_html($address) . '</div>';
    }
    
    $output .= '</div>';
    
    return $output;
}

// ========== Walker برای منوها ==========
class Rasa_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= $indent . '<li' . $class_names .'>';
        
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// ========== پشتیبانی از ووکامرس ==========
if (class_exists('WooCommerce')) {
    add_action('after_setup_theme', 'rasa_woocommerce_support');
    function rasa_woocommerce_support() {
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
}

// ========== SEO Meta Tags ==========
add_action('wp_head', 'rasa_seo_meta_tags');
function rasa_seo_meta_tags() {
    if (is_single() || is_page()) {
        global $post;
        
        $description = get_the_excerpt($post->ID);
        if (empty($description)) {
            $description = get_bloginfo('description');
        }
        $description = wp_trim_words(strip_tags($description), 30, '...');
        ?>
        <meta name="description" content="<?php echo esc_attr($description); ?>">
        <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>">
        <meta property="og:description" content="<?php echo esc_attr($description); ?>">
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
        <?php
    }
}

// ========== پشتیبانی از SVG ==========
add_filter('upload_mimes', 'rasa_mime_types');
function rasa_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['webp'] = 'image/webp';
    return $mimes;
}

// ========== شمارنده بازدید ==========
function rasa_set_post_views($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $count_key = 'rasa_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '1');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
    
    return $count;
}

// ========== پشتیبانی از Contact Form 7 ==========
add_filter('wpcf7_autop_or_not', '__return_false');

// ========== امنیت ==========
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// ========== بهینه‌سازی تصاویر ==========
add_filter('wp_get_attachment_image_attributes', 'rasa_image_attributes', 10, 3);
function rasa_image_attributes($attr, $attachment, $size) {
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }
    
    return $attr;
}

// ========== پایان فایل ==========