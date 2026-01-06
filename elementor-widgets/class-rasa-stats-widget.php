<?php
/**
 * Rasa Stats Widget for Elementor
 */

class Rasa_Stats_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_stats';
    }
    
    public function get_title() {
        return 'آمار رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-counter';
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
                'default' => 'درباره رسا سیستم در اعداد',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'دستاوردها و تجربیات ما در طول سال‌های فعالیت',
                'rows' => 2,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'stat_icon',
            [
                'label' => 'آیکون',
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chart-line',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $repeater->add_control(
            'stat_number',
            [
                'label' => 'عدد',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 0,
                'step' => 1,
            ]
        );
        
        $repeater->add_control(
            'stat_suffix',
            [
                'label' => 'پسوند',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '+',
                'placeholder' => 'مثال: + یا %',
            ]
        );
        
        $repeater->add_control(
            'stat_label',
            [
                'label' => 'برچسب',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'پروژه موفق',
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'stat_prefix',
            [
                'label' => 'پیشوند',
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'مثال: بیش از',
            ]
        );
        
        $this->add_control(
            'stats_list',
            [
                'label' => 'لیست آمارها',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stat_number' => 50,
                        'stat_label' => 'پروژه موفق',
                        'stat_icon' => ['value' => 'fas fa-project-diagram'],
                    ],
                    [
                        'stat_number' => 15,
                        'stat_label' => 'سال تجربه',
                        'stat_icon' => ['value' => 'fas fa-calendar-alt'],
                    ],
                    [
                        'stat_number' => 100,
                        'stat_label' => 'مشتری راضی',
                        'stat_icon' => ['value' => 'fas fa-users'],
                    ],
                    [
                        'stat_number' => 24,
                        'stat_label' => 'ساعت پشتیبانی',
                        'stat_icon' => ['value' => 'fas fa-headset'],
                    ],
                ],
                'title_field' => '{{{ stat_label }}}',
            ]
        );
        
        $this->add_control(
            'animation_duration',
            [
                'label' => 'مدت زمان انیمیشن (میلی‌ثانیه)',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 2000,
                'min' => 500,
                'max' => 5000,
                'step' => 100,
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
            'number_color',
            [
                'label' => 'رنگ اعداد',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-stat-number' => 'color: {{VALUE}}',
                ],
                'default' => '#E63946',
            ]
        );
        
        $this->add_control(
            'icon_background',
            [
                'label' => 'رنگ پس‌زمینه آیکون',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-stat-icon' => 'background-color: {{VALUE}}',
                ],
                'default' => 'rgba(229, 57, 70, 0.1)',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="rasa-stats-widget">
            <div class="rasa-stats-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-stats-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-stats-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="rasa-stats-grid" data-duration="<?php echo esc_attr($settings['animation_duration']); ?>">
                <?php foreach ($settings['stats_list'] as $index => $stat) : ?>
                    <div class="rasa-stat-item">
                        <div class="rasa-stat-icon">
                            <?php if ($stat['stat_icon']['value']) : ?>
                                <?php \Elementor\Icons_Manager::render_icon($stat['stat_icon'], ['aria-hidden' => 'true']); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="rasa-stat-content">
                            <div class="rasa-stat-number" 
                                 data-count="<?php echo esc_attr($stat['stat_number']); ?>"
                                 data-suffix="<?php echo esc_attr($stat['stat_suffix']); ?>"
                                 data-prefix="<?php echo esc_attr($stat['stat_prefix']); ?>">
                                <?php if ($stat['stat_prefix']) : ?>
                                    <span class="stat-prefix"><?php echo esc_html($stat['stat_prefix']); ?></span>
                                <?php endif; ?>
                                0<?php echo esc_html($stat['stat_suffix']); ?>
                            </div>
                            
                            <div class="rasa-stat-label"><?php echo esc_html($stat['stat_label']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <style>
        .rasa-stats-widget {
            padding: 80px 20px;
            background: var(--dark-bg, #121212);
            border-radius: 20px;
            margin: 30px 0;
        }
        
        .rasa-stats-header {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .rasa-stats-title {
            font-size: 2.8rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-stats-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .rasa-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .rasa-stat-item {
            text-align: center;
            padding: 30px;
            background: var(--card-bg, #1A1A1A);
            border-radius: 20px;
            border: 1px solid var(--border-color, #2A2A2A);
            transition: all 0.3s ease;
        }
        
        .rasa-stat-item:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 15px 40px rgba(229, 57, 70, 0.15);
        }
        
        .rasa-stat-icon {
            width: 80px;
            height: 80px;
            background: rgba(229, 57, 70, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            transition: all 0.3s ease;
        }
        
        .rasa-stat-item:hover .rasa-stat-icon {
            background: var(--primary-red, #E63946);
            transform: rotate(15deg) scale(1.1);
        }
        
        .rasa-stat-icon i,
        .rasa-stat-icon svg {
            font-size: 2.5rem;
            color: var(--primary-red, #E63946);
            transition: all 0.3s ease;
        }
        
        .rasa-stat-item:hover .rasa-stat-icon i,
        .rasa-stat-item:hover .rasa-stat-icon svg {
            color: white;
        }
        
        .rasa-stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary-red, #E63946);
            margin-bottom: 10px;
            line-height: 1;
        }
        
        .rasa-stat-number .stat-prefix {
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--text-gray, #B0B0B0);
        }
        
        .rasa-stat-label {
            font-size: 1.2rem;
            color: var(--text-light, #FFFFFF);
            font-weight: 600;
        }
        
        @media (max-width: 992px) {
            .rasa-stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
            
            .rasa-stats-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .rasa-stats-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
            }
            
            .rasa-stats-title {
                font-size: 2rem;
            }
            
            .rasa-stat-number {
                font-size: 3rem;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            function animateCounter(element) {
                const $element = $(element);
                const count = parseInt($element.data('count'));
                const suffix = $element.data('suffix') || '';
                const prefix = $element.data('prefix') || '';
                const duration = $('.rasa-stats-grid').data('duration') || 2000;
                
                $({ countNum: 0 }).animate({
                    countNum: count
                }, {
                    duration: duration,
                    easing: 'swing',
                    step: function() {
                        const current = Math.floor(this.countNum);
                        $element.html(prefix + current.toLocaleString('fa-IR') + suffix);
                    },
                    complete: function() {
                        $element.html(prefix + count.toLocaleString('fa-IR') + suffix);
                    }
                });
            }
            
            // Use Intersection Observer for scroll animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            // Observe all stat numbers
            $('.rasa-stat-number').each(function() {
                observer.observe(this);
            });
            
            // Also animate on hover
            $('.rasa-stat-item').on('mouseenter', function() {
                const $number = $(this).find('.rasa-stat-number');
                if (!$number.data('animated')) {
                    $number.data('animated', true);
                    animateCounter($number);
                }
            });
        });
        </script>
        
        <?php
    }
}