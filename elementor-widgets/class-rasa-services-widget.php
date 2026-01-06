<?php
/**
 * Rasa Services Widget for Elementor
 */

class Rasa_Services_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_services';
    }
    
    public function get_title() {
        return 'خدمات رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-icon-box';
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
                'label' => 'عنوان بخش',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'خدمات تخصصی ما',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'راهکارهای جامع برای مدیریت هوشمند کسب‌وکار',
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'service_icon',
            [
                'label' => 'آیکون',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-laptop-code',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $repeater->add_control(
            'service_title',
            [
                'label' => 'عنوان خدمت',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'توسعه نرم‌افزار سفارشی',
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'service_description',
            [
                'label' => 'توضیحات خدمت',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'طراحی و توسعه نرم‌افزارهای سازمانی متناسب با نیازهای خاص هر کسب‌وکار',
                'rows' => 3,
            ]
        );
        
        $repeater->add_control(
            'service_link',
            [
                'label' => 'لینک خدمت',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
            ]
        );
        
        $this->add_control(
            'services_list',
            [
                'label' => 'لیست خدمات',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => 'توسعه نرم‌افزار سفارشی',
                        'service_description' => 'طراحی و توسعه نرم‌افزارهای سازمانی',
                    ],
                    [
                        'service_title' => 'راه‌حل‌های ابری',
                        'service_description' => 'ارائه سرویس‌های ابری امن و مقیاس‌پذیر',
                    ],
                    [
                        'service_title' => 'اپلیکیشن موبایل',
                        'service_description' => 'توسعه اپلیکیشن‌های موبایل برای iOS و Android',
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
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
            'card_background',
            [
                'label' => 'رنگ کارت‌ها',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-service-card' => 'background-color: {{VALUE}}',
                ],
                'default' => '#1A1A1A',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="rasa-services-widget">
            <div class="rasa-services-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-services-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-services-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="rasa-services-grid">
                <?php foreach ($settings['services_list'] as $index => $service) : 
                    $link_attr = '';
                    if (!empty($service['service_link']['url'])) {
                        $link_attr = 'href="' . esc_url($service['service_link']['url']) . '"';
                        if ($service['service_link']['is_external']) {
                            $link_attr .= ' target="_blank"';
                        }
                        if ($service['service_link']['nofollow']) {
                            $link_attr .= ' rel="nofollow"';
                        }
                    }
                ?>
                    <div class="rasa-service-card">
                        <div class="rasa-service-icon">
                            <?php if ($service['service_icon']['value']) : ?>
                                <?php \Elementor\Icons_Manager::render_icon($service['service_icon'], ['aria-hidden' => 'true']); ?>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="rasa-service-title"><?php echo esc_html($service['service_title']); ?></h3>
                        
                        <p class="rasa-service-description"><?php echo esc_html($service['service_description']); ?></p>
                        
                        <?php if ($link_attr) : ?>
                            <a <?php echo $link_attr; ?> class="rasa-service-link">
                                اطلاعات بیشتر <i class="fas fa-arrow-left"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <style>
        .rasa-services-widget {
            padding: 50px 20px;
        }
        
        .rasa-services-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .rasa-services-title {
            font-size: 2.5rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-services-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .rasa-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .rasa-service-card {
            background: var(--card-bg, #1A1A1A);
            border: 1px solid var(--border-color, #2A2A2A);
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s ease;
        }
        
        .rasa-service-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 10px 30px rgba(229, 57, 70, 0.15);
        }
        
        .rasa-service-icon {
            width: 70px;
            height: 70px;
            background: rgba(229, 57, 70, 0.1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .rasa-service-icon i,
        .rasa-service-icon svg {
            font-size: 2rem;
            color: var(--primary-red, #E63946);
        }
        
        .rasa-service-title {
            font-size: 1.4rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-service-description {
            color: var(--text-gray, #B0B0B0);
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        .rasa-service-link {
            color: var(--primary-red, #E63946);
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s ease;
        }
        
        .rasa-service-link:hover {
            gap: 12px;
        }
        
        @media (max-width: 768px) {
            .rasa-services-grid {
                grid-template-columns: 1fr;
            }
            
            .rasa-services-title {
                font-size: 2rem;
            }
        }
        </style>
        <?php
    }
}