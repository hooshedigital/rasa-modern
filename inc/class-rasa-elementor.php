<?php
/**
 * Rasa Elementor Integration Class
 */

class Rasa_Elementor_Integration {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init_hooks();
    }
    
    private function init_hooks() {
        // Register Elementor locations
        add_action('elementor/theme/register_locations', [$this, 'register_locations']);
        
        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        
        // Add custom categories
        add_action('elementor/elements/categories_registered', [$this, 'add_categories']);
        
        // Add editor assets
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_assets']);
        
        // Add frontend assets
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets'], 100);
    }
    
    public function register_locations($elementor_theme_manager) {
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            return;
        }
        
        $locations = [
            'header' => [
                'label' => 'هدر',
                'multiple' => true,
                'edit_in_content' => true,
            ],
            'footer' => [
                'label' => 'فوتر',
                'multiple' => true,
                'edit_in_content' => true,
            ],
            'single' => [
                'label' => 'تک پست',
                'multiple' => true,
            ],
            'archive' => [
                'label' => 'آرشیو',
                'multiple' => true,
            ],
            'page' => [
                'label' => 'صفحه',
                'multiple' => true,
            ],
        ];
        
        foreach ($locations as $location => $args) {
            $elementor_theme_manager->register_location($location, $args);
        }
    }
    
    public function register_widgets($widgets_manager) {
        // Check if custom widgets are enabled
        if (get_option('rasa_elementor_widgets', '1') !== '1') {
            return;
        }
        
        $widgets = [
            'hero' => 'Rasa_Hero_Widget',
            'services' => 'Rasa_Services_Widget',
            'products' => 'Rasa_Products_Widget',
            'team' => 'Rasa_Team_Widget',
            'testimonials' => 'Rasa_Testimonials_Widget',
            'contact' => 'Rasa_Contact_Widget',
            'clients' => 'Rasa_Clients_Widget',
            'stats' => 'Rasa_Stats_Widget',
            'pricing' => 'Rasa_Pricing_Widget',
            'blog' => 'Rasa_Blog_Widget',
        ];
        
        foreach ($widgets as $file => $class_name) {
            $file_path = get_template_directory() . "/elementor-widgets/class-{$file}-widget.php";
            
            if (file_exists($file_path)) {
                require_once $file_path;
                
                if (class_exists($class_name)) {
                    $widgets_manager->register(new $class_name());
                }
            }
        }
    }
    
    public function add_categories($elements_manager) {
        $elements_manager->add_category('rasa-elements', [
            'title' => 'رسا سیستم',
            'icon' => 'eicon-custom',
        ]);
        
        $elements_manager->add_category('rasa-pro', [
            'title' => 'رسا سیستم PRO',
            'icon' => 'eicon-pro-icon',
        ]);
    }
    
    public function enqueue_editor_assets() {
        // Editor CSS
        wp_enqueue_style(
            'rasa-elementor-editor',
            get_template_directory_uri() . '/assets/css/elementor-editor.css',
            ['elementor-editor'],
            '3.5'
        );
        
        // Editor JS
        wp_enqueue_script(
            'rasa-elementor-editor',
            get_template_directory_uri() . '/assets/js/elementor-editor.js',
            ['jquery', 'elementor-editor'],
            '3.5',
            true
        );
        
        // Localize script
        wp_localize_script('rasa-elementor-editor', 'rasaElementorSettings', [
            'theme_version' => '3.5',
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('rasa_elementor_nonce'),
            'colors' => $this->get_theme_colors(),
            'fonts' => $this->get_theme_fonts(),
        ]);
    }
    
    public function enqueue_frontend_assets() {
        if (!class_exists('Elementor\Plugin')) {
            return;
        }
        
        // Frontend CSS
        wp_enqueue_style(
            'rasa-elementor-frontend',
            get_template_directory_uri() . '/assets/css/elementor-override.css',
            ['elementor-frontend'],
            '3.5'
        );
        
        // Frontend JS
        wp_enqueue_script(
            'rasa-elementor-frontend',
            get_template_directory_uri() . '/assets/js/elementor-frontend.js',
            ['jquery', 'elementor-frontend'],
            '3.5',
            true
        );
    }
    
    private function get_theme_colors() {
        return [
            'primary_red' => get_option('rasa_color_primary_red', '#E63946'),
            'primary_blue' => get_option('rasa_color_primary_blue', '#457B9D'),
            'dark_bg' => get_option('rasa_color_dark_bg', '#121212'),
            'card_bg' => get_option('rasa_color_card_bg', '#1A1A1A'),
            'text_light' => get_option('rasa_color_text_light', '#FFFFFF'),
            'text_gray' => get_option('rasa_color_text_gray', '#B0B0B0'),
        ];
    }
    
    private function get_theme_fonts() {
        return [
            'primary' => 'Vazirmatn, sans-serif',
            'secondary' => 'Segoe UI, Tahoma, sans-serif',
        ];
    }
    
    // Helper methods
    public static function is_elementor_page($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        if (class_exists('Elementor\Plugin')) {
            return \Elementor\Plugin::$instance->db->is_built_with_elementor($post_id);
        }
        
        return false;
    }
    
    public static function get_elementor_content($post_id = null) {
        if (!$post_id) {
            $post_id = get_the_ID();
        }
        
        if (self::is_elementor_page($post_id) && class_exists('Elementor\Plugin')) {
            return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
        }
        
        return false;
    }
    
    public static function has_elementor_header() {
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            return false;
        }
        
        return function_exists('elementor_theme_do_location') && elementor_location_exits('header');
    }
    
    public static function has_elementor_footer() {
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            return false;
        }
        
        return function_exists('elementor_theme_do_location') && elementor_location_exits('footer');
    }
}

// Initialize
Rasa_Elementor_Integration::get_instance();