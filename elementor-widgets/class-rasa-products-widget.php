<?php
/**
 * Rasa Products Widget for Elementor
 */

class Rasa_Products_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_products';
    }
    
    public function get_title() {
        return 'محصولات رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-products';
    }
    
    public function get_categories() {
        return ['rasa-elements'];
    }
    
    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => 'محتوا',
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        
        $this->add_control('title', [
            'label' => 'عنوان',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'محصولات ما',
        ]);
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="rasa-products-widget">
            <h2><?php echo esc_html($settings['title']); ?></h2>
            <p>ویجت محصولات رسا سیستم</p>
        </div>
        <?php
    }
}