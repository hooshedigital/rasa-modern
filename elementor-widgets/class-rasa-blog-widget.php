<?php
/**
 * Rasa Blog Widget for Elementor
 */

class Rasa_Blog_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'rasa_blog';
    }
    
    public function get_title() {
        return 'وبلاگ رسا سیستم';
    }
    
    public function get_icon() {
        return 'eicon-posts-grid';
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
                'default' => 'آخرین مقالات',
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => 'توضیحات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'مطالب آموزشی و اخبار حوزه نرم‌افزارهای سازمانی',
                'rows' => 2,
            ]
        );
        
        $this->add_control(
            'posts_per_page',
            [
                'label' => 'تعداد پست‌ها',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 12,
            ]
        );
        
        $this->add_control(
            'orderby',
            [
                'label' => 'مرتب‌سازی بر اساس',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => 'تاریخ',
                    'title' => 'عنوان',
                    'rand' => 'تصادفی',
                    'comment_count' => 'تعداد نظرات',
                    'modified' => 'تاریخ ویرایش',
                ],
            ]
        );
        
        $this->add_control(
            'order',
            [
                'label' => 'ترتیب',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => 'نزولی',
                    'ASC' => 'صعودی',
                ],
            ]
        );
        
        $this->add_control(
            'show_category',
            [
                'label' => 'نمایش دسته‌بندی',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_date',
            [
                'label' => 'نمایش تاریخ',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'show_excerpt',
            [
                'label' => 'نمایش خلاصه',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'excerpt_length',
            [
                'label' => 'طول خلاصه (کلمه)',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
                'min' => 5,
                'max' => 100,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'show_button',
            [
                'label' => 'نمایش دکمه',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'بله',
                'label_off' => 'خیر',
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label' => 'متن دکمه',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مشاهده همه مقالات',
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'button_url',
            [
                'label' => 'لینک دکمه',
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => get_permalink(get_option('page_for_posts')),
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'show_button' => 'yes',
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
            'card_background',
            [
                'label' => 'رنگ کارت‌ها',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rasa-blog-post' => 'background-color: {{VALUE}}',
                ],
                'default' => '#1A1A1A',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Query posts
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'post_status' => 'publish',
        ];
        
        $blog_query = new WP_Query($args);
        
        $button_url = $settings['button_url']['url'];
        $button_external = $settings['button_url']['is_external'] ? 'target="_blank"' : '';
        $button_nofollow = $settings['button_url']['nofollow'] ? 'rel="nofollow"' : '';
        ?>
        
        <div class="rasa-blog-widget">
            <div class="rasa-blog-header">
                <?php if ($settings['title']) : ?>
                    <h2 class="rasa-blog-title"><?php echo esc_html($settings['title']); ?></h2>
                <?php endif; ?>
                
                <?php if ($settings['description']) : ?>
                    <p class="rasa-blog-description"><?php echo esc_html($settings['description']); ?></p>
                <?php endif; ?>
            </div>
            
            <?php if ($blog_query->have_posts()) : ?>
                <div class="rasa-blog-grid">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                        <article class="rasa-blog-post">
                            <?php if (has_post_thumbnail() && $settings['show_image'] !== 'no') : ?>
                                <a href="<?php the_permalink(); ?>" class="blog-post-image">
                                    <?php the_post_thumbnail('large', [
                                        'class' => 'img-fluid',
                                        'loading' => 'lazy'
                                    ]); ?>
                                    
                                    <?php if ('yes' === $settings['show_category']) : ?>
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) : ?>
                                            <div class="post-category">
                                                <?php echo esc_html($categories[0]->name); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="blog-post-content">
                                <?php if ('yes' === $settings['show_date']) : ?>
                                    <div class="post-meta">
                                        <span class="post-date">
                                            <i class="far fa-calendar"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php if ('yes' === $settings['show_excerpt']) : ?>
                                    <div class="post-excerpt">
                                        <?php 
                                        $excerpt = get_the_excerpt();
                                        if ($settings['excerpt_length']) {
                                            $excerpt = wp_trim_words($excerpt, $settings['excerpt_length']);
                                        }
                                        echo wp_kses_post($excerpt);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <a href="<?php the_permalink(); ?>" class="post-read-more">
                                    ادامه مطلب
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                
                <?php if ('yes' === $settings['show_button'] && $settings['button_text']) : ?>
                    <div class="rasa-blog-footer">
                        <a href="<?php echo esc_url($button_url); ?>" 
                           class="rasa-blog-button"
                           <?php echo $button_external; ?> <?php echo $button_nofollow; ?>>
                            <?php echo esc_html($settings['button_text']); ?>
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                <?php endif; ?>
                
            <?php else : ?>
                <div class="no-posts">
                    <i class="far fa-newspaper fa-3x"></i>
                    <p>مقاله‌ای برای نمایش وجود ندارد.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <style>
        .rasa-blog-widget {
            padding: 80px 20px;
        }
        
        .rasa-blog-header {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .rasa-blog-title {
            font-size: 2.8rem;
            color: var(--text-light, #FFFFFF);
            margin-bottom: 15px;
        }
        
        .rasa-blog-description {
            color: var(--text-gray, #B0B0B0);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .rasa-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .rasa-blog-post {
            background: var(--card-bg, #1A1A1A);
            border: 1px solid var(--border-color, #2A2A2A);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .rasa-blog-post:hover {
            transform: translateY(-10px);
            border-color: var(--primary-red, #E63946);
            box-shadow: 0 20px 40px rgba(229, 57, 70, 0.15);
        }
        
        .blog-post-image {
            display: block;
            position: relative;
            overflow: hidden;
            height: 250px;
        }
        
        .blog-post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .rasa-blog-post:hover .blog-post-image img {
            transform: scale(1.1);
        }
        
        .post-category {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--primary-red, #E63946);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .blog-post-content {
            padding: 30px;
        }
        
        .post-meta {
            margin-bottom: 15px;
        }
        
        .post-date {
            color: var(--text-gray, #B0B0B0);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .post-title {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .post-title a {
            color: var(--text-light, #FFFFFF);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .post-title a:hover {
            color: var(--primary-red, #E63946);
        }
        
        .post-excerpt {
            color: var(--text-gray, #B0B0B0);
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        .post-read-more {
            color: var(--primary-red, #E63946);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: gap 0.3s ease;
        }
        
        .post-read-more:hover {
            gap: 12px;
        }
        
        .rasa-blog-footer {
            text-align: center;
        }
        
        .rasa-blog-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--primary-red, #E63946);
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .rasa-blog-button:hover {
            background: var(--dark-red, #8E0000);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(229, 57, 70, 0.2);
        }
        
        .no-posts {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-gray, #B0B0B0);
        }
        
        .no-posts i {
            margin-bottom: 20px;
            color: var(--border-color, #2A2A2A);
        }
        
        @media (max-width: 992px) {
            .rasa-blog-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
            
            .rasa-blog-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .rasa-blog-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto 40px;
            }
            
            .rasa-blog-title {
                font-size: 2rem;
            }
            
            .blog-post-content {
                padding: 25px;
            }
        }
        </style>
        
        <script>
        jQuery(document).ready(function($) {
            // Add hover effects to blog posts
            $('.rasa-blog-post').on('mouseenter', function() {
                $(this).find('.post-title a').css('color', 'var(--primary-red)');
            }).on('mouseleave', function() {
                $(this).find('.post-title a').css('color', '');
            });
            
            // Add lazy loading for images
            $('.blog-post-image img').each(function() {
                if ($(this).attr('loading') !== 'lazy') {
                    $(this).attr('loading', 'lazy');
                }
            });
        });
        </script>
        
        <?php
    }
}