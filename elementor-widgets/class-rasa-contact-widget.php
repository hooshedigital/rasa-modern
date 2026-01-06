<?php
/**
 * Rasa Contact Widget for Elementor
 */

class Rasa_Contact_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_contact';
    }
    
    public function get_title() {
        return 'تماس رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-form-horizontal';
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
                'default' => 'تماس با ما',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'برای دریافت مشاوره رایگان و اطلاعات بیشتر با ما در ارتباط باشید',
                'rows' => 3,
            ]
        );
        
        $this->add_control(
            'show_phone',
            [
                'label' => 'نمایش تلفن',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'phone_label',
            [
                'label' => 'برچسب تلفن',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'تلفن تماس',
                'condition' => [
                    'show_phone' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'phone_number',
            [
                'label' => 'شماره تلفن',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '۰۹۱۲-۸۷۰-۲۱۲۴',
                'condition' => [
                    'show_phone' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_email',
            [
                'label' => 'نمایش ایمیل',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'email_label',
            [
                'label' => 'برچسب ایمیل',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'ایمیل',
                'condition' => [
                    'show_email' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'email_address',
            [
                'label' => 'آدرس ایمیل',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'info@rasasystemco.com',
                'condition' => [
                    'show_email' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_address',
            [
                'label' => 'نمایش آدرس',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'address_label',
            [
                'label' => 'برچسب آدرس',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'آدرس دفتر',
                'condition' => [
                    'show_address' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'address_text',
            [
                'label' => 'متن آدرس',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'تهران، خیابان ولیعصر',
                'rows' => 2,
                'condition' => [
                    'show_address' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_form',
            [
                'label' => 'نمایش فرم تماس',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
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
            'background_color',
            [
                'label' => 'رنگ پس‌زمینه',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-contact-widget' => 'background-color: {{VALUE}}',
                ],
                'default' => '#1A1A1A',
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => 'رنگ عنوان',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-contact-title' => 'color: {{VALUE}}',
                ],
                'default' => '#FFFFFF',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        
        <div class="rasa-contact-widget">
            <div class="rasa-contact-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-contact-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-contact-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="rasa-contact-info">
                <?php if ('yes' === $settings['show_phone']) : ?>
                    <div class="rasa-contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-content">
                            <h4><?php echo esc_html($settings['phone_label']); ?></h4>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $settings['phone_number'])); ?>">
                                <?php echo esc_html($settings['phone_number']); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ('yes' === $settings['show_email']) : ?>
                    <div class="rasa-contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <h4><?php echo esc_html($settings['email_label']); ?></h4>
                            <a href="mailto:<?php echo esc_attr($settings['email_address']); ?>">
                                <?php echo esc_html($settings['email_address']); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ('yes' === $settings['show_address']) : ?>
                    <div class="rasa-contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-content">
                            <h4><?php echo esc_html($settings['address_label']); ?></h4>
                            <p><?php echo nl2br(esc_html($settings['address_text'])); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ('yes' === $settings['show_form']) : ?>
                <div class="rasa-contact-form">
                    <form class="rasa-form" id="contactWidgetForm">
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="نام و نام خانوادگی" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="آدرس ایمیل" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="شماره تماس">
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="پیام شما..." rows="4" required></textarea>
                        </div>
                        <button type="submit" class="rasa-submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            ارسال پیام
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        
        <style>
        .rasa-contact-widget {
            background: var(--card-bg, #1A1A1A);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid var(--border-color, #2A2A2A);
        }
        
        .rasa-contact-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .rasa-contact-title {
            font-size: 2.5rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-contact-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }
        
        .rasa-contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .rasa-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .rasa-contact-item:hover {
            border-color: var(--primary-red, #E63946);
            transform: translateY(-5px);
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(229, 57, 70, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .contact-icon i {
            font-size: 1.5rem;
            color: var(--primary-red, #E63946);
        }
        
        .contact-content h4 {
            color: var(--text-light, #FFFFFF);
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .contact-content a,
        .contact-content p {
            color: var(--text-gray, #B0B0B0);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .contact-content a:hover {
            color: var(--primary-red, #E63946);
        }
        
        .rasa-contact-form {
            background: rgba(255, 255, 255, 0.03);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .rasa-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: var(--text-light, #FFFFFF);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 0 0 3px rgba(229, 57, 70, 0.1);
        }
        
        .rasa-submit-btn {
            background: var(--primary-red, #E63946);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-family: 'Vazirmatn', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .rasa-submit-btn:hover {
            background: var(--dark-red, #8E0000);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .rasa-contact-info {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .rasa-contact-title {
                font-size: 2rem;
            }
            
            .rasa-contact-widget {
                padding: 25px;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            $('#contactWidgetForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const button = form.find('.rasa-submit-btn');
                
                button.html('<i class="fas fa-spinner fa-spin"></i> در حال ارسال...');
                
                // Simulate form submission
                setTimeout(() => {
                    button.html('<i class="fas fa-check"></i> پیام ارسال شد!').css('background', '#10B981');
                    
                    // Reset form
                    setTimeout(() => {
                        form.trigger('reset');
                        button.html('<i class="fas fa-paper-plane"></i> ارسال پیام').css('background', '');
                    }, 2000);
                }, 2000);
            });
        });
        </script>
        
        <?php
    }
}