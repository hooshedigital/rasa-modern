<?php
/**
 * Rasa Pricing Widget for Elementor
 */

class Rasa_Pricing_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_pricing';
    }
    
    public function get_title() {
        return 'قیمت‌گذاری رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-price-table';
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
                'default' => 'پلن‌های قیمت‌گذاری',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'انتخاب پلن مناسب برای سازمان شما',
                'rows' => 2,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'plan_name',
            [
                'label' => 'نام پلن',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'پلن پایه',
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'plan_price',
            [
                'label' => 'قیمت',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 290000,
                'min' => 0,
                'step' => 1000,
            ]
        );
        
        $repeater->add_control(
            'plan_period',
            [
                'label' => 'دوره',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'ماهیانه',
                'placeholder' => 'مثال: ماهیانه، سالیانه',
            ]
        );
        
        $repeater->add_control(
            'plan_currency',
            [
                'label' => 'واحد پول',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'تومان',
                'placeholder' => 'مثال: تومان، دلار',
            ]
        );
        
        $repeater->add_control(
            'plan_badge',
            [
                'label' => 'بدج',
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => 'مثال: پرفروش، جدید',
            ]
        );
        
        $repeater->add_control(
            'plan_features',
            [
                'label' => 'ویژگی‌ها',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "مدیریت مالی و حسابداری\nتا ۵ کاربر\n۱۰ گیگابایت ذخیره‌سازی\nپشتیبانی ایمیلی",
                'description' => 'هر ویژگی را در یک خط وارد کنید',
                'rows' => 6,
            ]
        );
        
        $repeater->add_control(
            'plan_button_text',
            [
                'label' => 'متن دکمه',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'انتخاب پلن',
            ]
        );
        
        $repeater->add_control(
            'plan_button_url',
            [
                'label' => 'لینک دکمه',
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#contact',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );
        
        $repeater->add_control(
            'plan_featured',
            [
                'label' => 'پلن ویژه',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'pricing_plans',
            [
                'label' => 'پلن‌های قیمت‌گذاری',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'plan_name' => 'پلن پایه',
                        'plan_price' => 290000,
                        'plan_features' => "مدیریت مالی و حسابداری\nتا ۵ کاربر\n۱۰ گیگابایت ذخیره‌سازی\nپشتیبانی ایمیلی\nبروزرسانی ماهیانه",
                    ],
                    [
                        'plan_name' => 'پلن حرفه‌ای',
                        'plan_price' => 590000,
                        'plan_badge' => 'پرفروش',
                        'plan_features' => "تمام ویژگی‌های پلن پایه\nسیستم انبارداری پیشرفته\nمنابع انسانی کامل\nسیستم CRM\nپشتیبانی ۲۴/۷\nبروزرسانی هفتگی",
                        'plan_featured' => 'yes',
                    ],
                    [
                        'plan_name' => 'پلن سازمانی',
                        'plan_price' => 1290000,
                        'plan_features' => "تمام ویژگی‌های پلن حرفه‌ای\nاتوماسیون اداری\nاپلیکیشن موبایل\nتعداد کاربران نامحدود\nذخیره‌سازی نامحدود\nبروزرسانی روزانه",
                    ],
                ],
                'title_field' => '{{{ plan_name }}}',
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
            'featured_background',
            [
                'label' => 'رنگ پلن ویژه',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(229, 57, 70, 0.1)',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="rasa-pricing-widget">
            <div class="rasa-pricing-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-pricing-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-pricing-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="rasa-pricing-grid">
                <?php foreach ($settings['pricing_plans'] as $index => $plan) : 
                    $button_url = $plan['plan_button_url']['url'];
                    $button_external = $plan['plan_button_url']['is_external'] ? 'target="_blank"' : '';
                    $button_nofollow = $plan['plan_button_url']['nofollow'] ? 'rel="nofollow"' : '';
                    
                    $is_featured = $plan['plan_featured'] === 'yes';
                    $features = explode("\n", $plan['plan_features']);
                ?>
                    <div class="rasa-pricing-card <?php echo $is_featured ? 'featured' : ''; ?>">
                        <?php if ($plan['plan_badge']) : ?>
                            <div class="pricing-badge"><?php echo esc_html($plan['plan_badge']); ?></div>
                        <?php endif; ?>
                        
                        <div class="pricing-header">
                            <h3 class="plan-name"><?php echo esc_html($plan['plan_name']); ?></h3>
                            
                            <div class="plan-price">
                                <span class="price-amount"><?php echo number_format($plan['plan_price']); ?></span>
                                <span class="price-currency"><?php echo esc_html($plan['plan_currency']); ?></span>
                            </div>
                            
                            <div class="plan-period"><?php echo esc_html($plan['plan_period']); ?></div>
                        </div>
                        
                        <div class="pricing-features">
                            <ul>
                                <?php foreach ($features as $feature) : 
                                    $feature = trim($feature);
                                    if ($feature) : ?>
                                        <li>
                                            <i class="fas fa-check"></i>
                                            <span><?php echo esc_html($feature); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <div class="pricing-footer">
                            <a href="<?php echo esc_url($button_url); ?>" 
                               class="pricing-button <?php echo $is_featured ? 'btn-primary' : 'btn-outline'; ?>"
                               <?php echo $button_external; ?> <?php echo $button_nofollow; ?>>
                                <?php echo esc_html($plan['plan_button_text']); ?>
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <style>
        .rasa-pricing-widget {
            padding: 80px 20px;
        }
        
        .rasa-pricing-header {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .rasa-pricing-title {
            font-size: 2.8rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-pricing-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .rasa-pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .rasa-pricing-card {
            background: var(--card-bg, #1A1A1A);
            border: 1px solid var(--border-color, #2A2A2A);
            border-radius: 20px;
            padding: 40px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .rasa-pricing-card.featured {
            background: <?php echo $settings['featured_background']; ?>;
            border: 2px solid var(--primary-red, #E63946);
            transform: scale(1.05);
            z-index: 1;
        }
        
        .rasa-pricing-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 20px 40px rgba(229, 57, 70, 0.15);
        }
        
        .rasa-pricing-card.featured:hover {
            transform: translateY(-10px) scale(1.05);
        }
        
        .pricing-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary-red, #E63946);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .pricing-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border-color, #2A2A2A);
        }
        
        .plan-name {
            font-size: 1.8rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .plan-price {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 5px;
            margin-bottom: 10px;
        }
        
        .price-amount {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-red, #E63946);
        }
        
        .price-currency {
            font-size: 1.2rem;
            color: var(--text-gray, #B0B0B0);
        }
        
        .plan-period {
            color: var(--text-gray, #B0B0B0);
            font-size: 1rem;
        }
        
        .pricing-features {
            margin-bottom: 40px;
        }
        
        .pricing-features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: var(--text-gray, #B0B0B0);
        }
        
        .pricing-features li i {
            color: var(--primary-red, #E63946);
            font-size: 0.9rem;
        }
        
        .pricing-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 15px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .btn-primary {
            background: var(--primary-red, #E63946);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--dark-red, #8E0000);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--primary-red, #E63946);
            border: 2px solid var(--primary-red, #E63946);
        }
        
        .btn-outline:hover {
            background: rgba(229, 57, 70, 0.1);
        }
        
        @media (max-width: 992px) {
            .rasa-pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .rasa-pricing-card.featured {
                transform: none;
            }
            
            .rasa-pricing-card.featured:hover {
                transform: translateY(-10px);
            }
        }
        
        @media (max-width: 768px) {
            .rasa-pricing-grid {
                grid-template-columns: 1fr;
                max-width: 400px;
            }
            
            .rasa-pricing-title {
                font-size: 2rem;
            }
            
            .rasa-pricing-card {
                padding: 30px;
            }
        }
        </style>
        
        <?php
    }
}