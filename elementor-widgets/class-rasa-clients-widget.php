<?php
/**
 * Rasa Clients Widget for Elementor
 */

class Rasa_Clients_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_clients';
    }
    
    public function get_title() {
        return 'مشتریان رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-carousel';
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
                'label' => 'عنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مشتریان ما',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'همراهی سازمان‌های موفق در سراسر کشور',
                'rows' => 2,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'client_name',
            [
                'label' => 'نام مشتری',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'شرکت نمونه',
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'client_logo',
            [
                'label' => 'لوگوی مشتری',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'client_link',
            [
                'label' => 'لینک مشتری',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
            ]
        );
        
        $this->add_control(
            'clients_list',
            [
                'label' => 'لیست مشتریان',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['client_name' => 'شرکت صنعتی سپهر'],
                    ['client_name' => 'شرکت بازرگانی نیلوفر'],
                    ['client_name' => 'بیمارستان مهر'],
                    ['client_name' => 'شرکت پخش آرین'],
                    ['client_name' => 'بانک خصوصی'],
                    ['client_name' => 'سازمان دولتی'],
                ],
                'title_field' => '{{{ client_name }}}',
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => 'تعداد ستون‌ها',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '2' => '۲ ستون',
                    '3' => '۳ ستون',
                    '4' => '۴ ستون',
                    '5' => '۵ ستون',
                    '6' => '۶ ستون',
                ],
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label' => 'پخش خودکار',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'autoplay_speed',
            [
                'label' => 'سرعت پخش خودکار (میلی‌ثانیه)',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
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
            'logo_background',
            [
                'label' => 'رنگ پس‌زمینه لوگو',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-client-logo' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(255, 255, 255, 0.05)',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['columns'] ? 'col-' . (12 / intval($settings['columns'])) : 'col-2';
        ?>
        
        <div class="rasa-clients-widget">
            <div class="rasa-clients-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-clients-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-clients-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="rasa-clients-grid" 
                 data-autoplay="<?php echo $settings['autoplay'] === 'yes' ? 'true' : 'false'; ?>"
                 data-speed="<?php echo esc_attr($settings['autoplay_speed']); ?>">
                <?php foreach ($settings['clients_list'] as $index => $client) : 
                    $link_attr = '';
                    if (!empty($client['client_link']['url'])) {
                        $link_attr = 'href="' . esc_url($client['client_link']['url']) . '"';
                        if ($client['client_link']['is_external']) {
                            $link_attr .= ' target="_blank"';
                        }
                        if ($client['client_link']['nofollow']) {
                            $link_attr .= ' rel="nofollow"';
                        }
                    }
                ?>
                    <div class="rasa-client-item <?php echo esc_attr($columns); ?>">
                        <div class="rasa-client-logo">
                            <?php if ($link_attr) : ?>
                                <a <?php echo $link_attr; ?>>
                            <?php endif; ?>
                            
                            <?php if (!empty($client['client_logo']['url'])) : ?>
                                <img src="<?php echo esc_url($client['client_logo']['url']); ?>" 
                                     alt="<?php echo esc_attr($client['client_name']); ?>"
                                     loading="lazy">
                            <?php else : ?>
                                <div class="placeholder-logo">
                                    <?php echo esc_html($client['client_name']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($link_attr) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <style>
        .rasa-clients-widget {
            padding: 50px 20px;
        }
        
        .rasa-clients-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .rasa-clients-title {
            font-size: 2.5rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-clients-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .rasa-clients-grid {
            display: grid;
            grid-template-columns: repeat(<?php echo esc_attr($settings['columns']); ?>, 1fr);
            gap: 30px;
            align-items: center;
        }
        
        .rasa-client-item {
            text-align: center;
        }
        
        .rasa-client-logo {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .rasa-client-logo:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 10px 30px rgba(229, 57, 70, 0.15);
        }
        
        .rasa-client-logo img {
            max-width: 100%;
            max-height: 70px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .rasa-client-logo:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }
        
        .placeholder-logo {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        @media (max-width: 1200px) {
            .rasa-clients-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .rasa-clients-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .rasa-clients-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .rasa-client-logo {
                padding: 20px;
                height: 120px;
            }
            
            .rasa-clients-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .rasa-clients-grid {
                grid-template-columns: 1fr;
                max-width: 300px;
                margin: 0 auto;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            const grid = $('.rasa-clients-grid');
            const autoplay = grid.data('autoplay') === 'true';
            const speed = grid.data('speed') || 3000;
            
            if (autoplay) {
                let currentIndex = 0;
                const items = grid.find('.rasa-client-item');
                const totalItems = items.length;
                
                function rotateLogos() {
                    items.removeClass('active');
                    $(items[currentIndex]).addClass('active');
                    
                    currentIndex = (currentIndex + 1) % totalItems;
                }
                
                // Initial call
                rotateLogos();
                
                // Set interval for rotation
                setInterval(rotateLogos, speed);
            }
            
            // Add hover effect
            $('.rasa-client-logo').on('mouseenter', function() {
                $(this).css({
                    'transform': 'translateY(-10px) scale(1.05)',
                    'z-index': '10'
                });
            }).on('mouseleave', function() {
                $(this).css({
                    'transform': '',
                    'z-index': ''
                });
            });
        });
        </script>
        
        <?php
    }
}