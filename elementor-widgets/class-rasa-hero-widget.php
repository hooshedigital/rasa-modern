<?php
/**
 * Rasa Hero Widget for Elementor
 */

class Rasa_Hero_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_hero';
    }
    
    public function get_title() {
        return 'هیرو رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-banner';
    }
    
    public function get_categories() {
        return ['rasa-elements'];
    }
    
    protected function _register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'محتوا',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label' => 'عنوان اصلی',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'راهکارهای نرم‌افزاری مالی و سازمانی',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'ارائه‌دهنده سامانه‌های تخصصی برای مدیریت مالی، حسابداری، منابع انسانی و اتوماسیون فرآیندهای سازمانی با بیش از ۱۵ سال تجربه',
                'rows' => 4,
            ]
        );
        
        $this->add_control(
            'button1_text',
            [
                'label' => 'متن دکمه اول',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مشاهده محصولات',
            ]
        );
        
        $this->add_control(
            'button1_url',
            [
                'label' => 'لینک دکمه اول',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'show_external' => true,
                'default' => [
                    'url' => '#products',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
        $this->add_control(
            'button2_text',
            [
                'label' => 'متن دکمه دوم',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'درخواست مشاوره',
            ]
        );
        
        $this->add_control(
            'button2_url',
            [
                'label' => 'لینک دکمه دوم',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'show_external' => true,
                'default' => [
                    'url' => '#contact',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => 'استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => 'رنگ عنوان',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-hero-title' => 'color: {{VALUE}}',
                ],
                'default' => '#FFFFFF',
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => 'رنگ توضیحات',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-hero-description' => 'color: {{VALUE}}',
                ],
                'default' => '#B0B0B0',
            ]
        );
        
        $this->add_control(
            'background_color',
            [
                'label' => 'رنگ پس‌زمینه',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-hero-widget' => 'background-color: {{VALUE}}',
                ],
                'default' => '#121212',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => 'تایپوگرافی عنوان',
                'selector' => '{{WRAPPER}} .rasa-hero-title',
            ]
        );
        
        $this->end_controls_section();
        
        // Button Style Section
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => 'استایل دکمه‌ها',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'button1_background',
            [
                'label' => 'رنگ دکمه اول',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-hero-btn-primary' => 'background-color: {{VALUE}}',
                ],
                'default' => '#E63946',
            ]
        );
        
        $this->add_control(
            'button2_background',
            [
                'label' => 'رنگ دکمه دوم',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-hero-btn-secondary' => 'background-color: {{VALUE}}',
                ],
                'default' => 'transparent',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $button1_url = $settings['button1_url']['url'];
        $button1_external = $settings['button1_url']['is_external'] ? 'target="_blank"' : '';
        $button1_nofollow = $settings['button1_url']['nofollow'] ? 'rel="nofollow"' : '';
        
        $button2_url = $settings['button2_url']['url'];
        $button2_external = $settings['button2_url']['is_external'] ? 'target="_blank"' : '';
        $button2_nofollow = $settings['button2_url']['nofollow'] ? 'rel="nofollow"' : '';
        ?>
        
        <div class="rasa-hero-widget">
            <div class="rasa-hero-content">
                <h1 class="rasa-hero-title">
                    <?php echo esc_html($settings['title']); ?>
                </h1>
                
                <p class="rasa-hero-description">
                    <?php echo esc_html($settings['description']); ?>
                </p>
                
                <div class="rasa-hero-buttons">
                    <?php if ($settings['button1_text']) : ?>
                        <a href="<?php echo esc_url($button1_url); ?>" 
                           class="rasa-hero-btn rasa-hero-btn-primary"
                           <?php echo $button1_external; ?> <?php echo $button1_nofollow; ?>>
                            <?php echo esc_html($settings['button1_text']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($settings['button2_text']) : ?>
                        <a href="<?php echo esc_url($button2_url); ?>" 
                           class="rasa-hero-btn rasa-hero-btn-secondary"
                           <?php echo $button2_external; ?> <?php echo $button2_nofollow; ?>>
                            <?php echo esc_html($settings['button2_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <style>
        .rasa-hero-widget {
            padding: 100px 20px;
            background: var(--dark-bg, #121212);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        
        .rasa-hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .rasa-hero-description {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 40px;
            line-height: 1.8;
        }
        
        .rasa-hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .rasa-hero-btn {
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .rasa-hero-btn-primary {
            background: var(--primary-red, #E63946);
            color: white;
        }
        
        .rasa-hero-btn-primary:hover {
            background: var(--dark-red, #8E0000);
            transform: translateY(-3px);
        }
        
        .rasa-hero-btn-secondary {
            background: transparent;
            color: var(--primary-red, #E63946);
            border-color: var(--primary-red, #E63946);
        }
        
        .rasa-hero-btn-secondary:hover {
            background: rgba(229, 57, 70, 0.1);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .rasa-hero-title {
                font-size: 2rem;
            }
            
            .rasa-hero-description {
                font-size: 1rem;
            }
            
            .rasa-hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .rasa-hero-btn {
                width: 100%;
                max-width: 300px;
            }
        }
        </style>
        <?php
    }
    
    protected function _content_template() {
        ?>
        <#
        var button1_url = settings.button1_url.url;
        var button1_external = settings.button1_url.is_external ? 'target="_blank"' : '';
        var button1_nofollow = settings.button1_url.nofollow ? 'rel="nofollow"' : '';
        
        var button2_url = settings.button2_url.url;
        var button2_external = settings.button2_url.is_external ? 'target="_blank"' : '';
        var button2_nofollow = settings.button2_url.nofollow ? 'rel="nofollow"' : '';
        #>
        
        <div class="rasa-hero-widget">
            <div class="rasa-hero-content">
                <h1 class="rasa-hero-title">
                    {{{ settings.title }}}
                </h1>
                
                <p class="rasa-hero-description">
                    {{{ settings.description }}}
                </p>
                
                <div class="rasa-hero-buttons">
                    <# if (settings.button1_text) { #>
                        <a href="{{ button1_url }}" 
                           class="rasa-hero-btn rasa-hero-btn-primary"
                           {{{ button1_external }}} {{{ button1_nofollow }}}>
                            {{{ settings.button1_text }}}
                        </a>
                    <# } #>
                    
                    <# if (settings.button2_text) { #>
                        <a href="{{ button2_url }}" 
                           class="rasa-hero-btn rasa-hero-btn-secondary"
                           {{{ button2_external }}} {{{ button2_nofollow }}}>
                            {{{ settings.button2_text }}}
                        </a>
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}