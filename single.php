<?php
/**
 * Rasa System v3.5 - Single Post Template
 * 
 * تمپلیت پست‌های تکی - پشتیبانی از Elementor
 */

get_header();

// چک کردن آیا پست با المنتور ساخته شده
$is_elementor_post = false;

if (class_exists('Elementor\Plugin')) {
    $is_elementor_post = Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID());
}

if ($is_elementor_post) {
    // اگر پست با المنتور ساخته شده باشد
    echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display(get_the_ID());
} else {
    // پست عادی وردپرس
    ?>
    <div class="single-post-wrapper">
        <div class="container">
            <div class="row">
                <!-- محتوای اصلی -->
                <div class="col-lg-8">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                                <!-- هدر پست -->
                                <header class="single-post-header">
                                    <!-- دسته‌بندی -->
                                    <div class="post-categories">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            foreach ($categories as $category) {
                                                printf(
                                                    '<a href="%s" class="post-category">%s</a>',
                                                    esc_url(get_category_link($category->term_id)),
                                                    esc_html($category->name)
                                                );
                                            }
                                        }
                                        ?>
                                    </div>
                                    
                                    <!-- عنوان -->
                                    <h1 class="post-title"><?php the_title(); ?></h1>
                                    
                                    <!-- متادیتا -->
                                    <div class="post-meta">
                                        <span class="post-author">
                                            <i class="fas fa-user"></i>
                                            <?php the_author(); ?>
                                        </span>
                                        <span class="post-date">
                                            <i class="far fa-calendar"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <span class="post-reading-time">
                                            <i class="far fa-clock"></i>
                                            <?php echo ceil(str_word_count(get_the_content()) / 200); ?> دقیقه خواندن
                                        </span>
                                        <span class="post-comments-count">
                                            <i class="far fa-comment"></i>
                                            <?php comments_number('بدون دیدگاه', '۱ دیدگاه', '% دیدگاه'); ?>
                                        </span>
                                    </div>
                                    
                                    <!-- تصویر شاخص -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-featured-image">
                                            <?php
                                            the_post_thumbnail('full', [
                                                'class' => 'img-fluid',
                                                'loading' => 'lazy'
                                            ]);
                                            ?>
                                            
                                            <?php if ($caption = get_the_post_thumbnail_caption()) : ?>
                                                <div class="featured-image-caption">
                                                    <?php echo esc_html($caption); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </header>
                                
                                <!-- محتوای پست -->
                                <div class="post-content">
                                    <?php the_content(); ?>
                                    
                                    <?php
                                    wp_link_pages([
                                        'before' => '<div class="page-links">' . esc_html__('صفحات:', 'rasa-system'),
                                        'after'  => '</div>',
                                    ]);
                                    ?>
                                </div>
                                
                                <!-- فوتر پست -->
                                <footer class="post-footer">
                                    <!-- تگ‌ها -->
                                    <div class="post-tags">
                                        <?php
                                        $tags = get_the_tags();
                                        if ($tags) {
                                            echo '<div class="tags-title">برچسب‌ها:</div>';
                                            foreach ($tags as $tag) {
                                                printf(
                                                    '<a href="%s" class="post-tag">%s</a>',
                                                    esc_url(get_tag_link($tag->term_id)),
                                                    esc_html($tag->name)
                                                );
                                            }
                                        }
                                        ?>
                                    </div>
                                    
                                    <!-- اشتراک گذاری -->
                                    <div class="post-sharing">
                                        <div class="sharing-title">اشتراک گذاری:</div>
                                        <div class="sharing-buttons">
                                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener" 
                                               class="sharing-button twitter"
                                               aria-label="اشتراک در توییتر">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener" 
                                               class="sharing-button linkedin"
                                               aria-label="اشتراک در لینکدین">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                            <a href="https://telegram.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                               target="_blank" 
                                               rel="noopener" 
                                               class="sharing-button telegram"
                                               aria-label="اشتراک در تلگرام">
                                                <i class="fab fa-telegram"></i>
                                            </a>
                                            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" 
                                               target="_blank" 
                                               rel="noopener" 
                                               class="sharing-button whatsapp"
                                               aria-label="اشتراک در واتساپ">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- نویسنده -->
                                    <div class="post-author-box">
                                        <div class="author-avatar">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                                        </div>
                                        <div class="author-info">
                                            <h4 class="author-name"><?php the_author(); ?></h4>
                                            <p class="author-bio"><?php echo get_the_author_meta('description'); ?></p>
                                            <div class="author-social">
                                                <?php
                                                $author_social = [
                                                    'twitter' => get_the_author_meta('twitter'),
                                                    'linkedin' => get_the_author_meta('linkedin'),
                                                    'instagram' => get_the_author_meta('instagram'),
                                                ];
                                                
                                                foreach ($author_social as $platform => $url) {
                                                    if ($url) {
                                                        printf(
                                                            '<a href="%s" target="_blank" rel="noopener" class="author-social-link %s"><i class="fab fa-%s"></i></a>',
                                                            esc_url($url),
                                                            esc_attr($platform),
                                                            esc_attr($platform)
                                                        );
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                            </article>
                            
                            <!-- پست‌های مرتبط -->
                            <?php
                            $related_posts = get_posts([
                                'category__in' => wp_get_post_categories(get_the_ID()),
                                'numberposts' => 3,
                                'post__not_in' => [get_the_ID()],
                                'orderby' => 'rand'
                            ]);
                            
                            if ($related_posts) :
                                ?>
                                <section class="related-posts-section">
                                    <h3 class="section-title">مقالات مرتبط</h3>
                                    <div class="related-posts-grid">
                                        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                            <article class="related-post">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <a href="<?php the_permalink(); ?>" class="related-post-image">
                                                        <?php the_post_thumbnail('medium', ['class' => 'img-fluid', 'loading' => 'lazy']); ?>
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <div class="related-post-content">
                                                    <div class="related-post-meta">
                                                        <span class="post-date"><?php echo get_the_date(); ?></span>
                                                    </div>
                                                    <h4 class="related-post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="related-post-excerpt">
                                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                                    </div>
                                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                                        ادامه مطلب <i class="fas fa-arrow-left"></i>
                                                    </a>
                                                </div>
                                            </article>
                                        <?php endforeach; wp_reset_postdata(); ?>
                                    </div>
                                </section>
                                <?php
                            endif;
                            ?>
                            
                            <!-- نظرات -->
                            <section class="comments-section">
                                <?php comments_template(); ?>
                            </section>
                            <?php
                        endwhile;
                    else :
                        get_template_part('template-parts/content', 'none');
                    endif;
                    ?>
                </div>
                
                <!-- سایدبار -->
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <?php
                        if (is_active_sidebar('main-sidebar')) {
                            dynamic_sidebar('main-sidebar');
                        } else {
                            // سایدبار پیش‌فرض
                            ?>
                            <div class="widget">
                                <h3 class="widget-title">جستجو</h3>
                                <?php get_search_form(); ?>
                            </div>
                            
                            <div class="widget">
                                <h3 class="widget-title">دسته‌بندی‌ها</h3>
                                <ul class="category-list">
                                    <?php
                                    wp_list_categories([
                                        'title_li' => '',
                                        'show_count' => true,
                                        'style' => 'list'
                                    ]);
                                    ?>
                                </ul>
                            </div>
                            
                            <div class="widget">
                                <h3 class="widget-title">آخرین مقالات</h3>
                                <ul class="recent-posts">
                                    <?php
                                    $recent_posts = wp_get_recent_posts([
                                        'numberposts' => 5,
                                        'post_status' => 'publish'
                                    ]);
                                    
                                    foreach ($recent_posts as $post) :
                                        ?>
                                        <li>
                                            <a href="<?php echo get_permalink($post['ID']); ?>">
                                                <?php echo get_the_post_thumbnail($post['ID'], [50, 50]); ?>
                                                <div class="recent-post-info">
                                                    <h4><?php echo $post['post_title']; ?></h4>
                                                    <span class="post-date"><?php echo get_the_date('', $post['ID']); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </div>
                            
                            <div class="widget">
                                <h3 class="widget-title">برچسب‌ها</h3>
                                <div class="tag-cloud">
                                    <?php
                                    wp_tag_cloud([
                                        'smallest' => 12,
                                        'largest' => 22,
                                        'unit' => 'px',
                                        'number' => 20,
                                        'format' => 'flat',
                                        'separator' => ' ',
                                        'orderby' => 'count',
                                        'order' => 'DESC',
                                        'show_count' => 0
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <?php
}

get_footer();