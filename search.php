<?php
/**
 * Rasa System v3.5 - Search Results Template
 */

get_header();

$search_query = get_search_query();
$total_results = $wp_query->found_posts;
?>

<div class="search-page-wrapper">
    <div class="container">
        <!-- هدر نتایج جستجو -->
        <header class="search-header">
            <h1 class="search-title">
                نتایج جستجو برای: 
                <span class="search-query">"<?php echo esc_html($search_query); ?>"</span>
            </h1>
            
            <div class="search-stats">
                <p>
                    <strong><?php echo $total_results; ?></strong> 
                    نتیجه یافت شد
                </p>
            </div>
            
            <!-- فرم جستجو -->
            <div class="search-form-container">
                <?php get_search_form(); ?>
            </div>
        </header>
        
        <!-- نتایج جستجو -->
        <div class="search-results">
            <?php if (have_posts()) : ?>
                <div class="results-list">
                    <?php
                    while (have_posts()) : the_post();
                        $post_type = get_post_type();
                        $post_type_obj = get_post_type_object($post_type);
                        ?>
                        <article class="search-result-item">
                            <!-- نوع محتوا -->
                            <div class="result-type">
                                <span class="type-badge">
                                    <?php echo $post_type_obj->labels->singular_name; ?>
                                </span>
                            </div>
                            
                            <!-- عنوان -->
                            <h3 class="result-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <!-- لینک -->
                            <div class="result-permalink">
                                <i class="fas fa-link"></i>
                                <?php echo esc_url(get_permalink()); ?>
                            </div>
                            
                            <!-- خلاصه با هایلایت -->
                            <div class="result-excerpt">
                                <?php
                                $excerpt = get_the_excerpt();
                                $highlighted = preg_replace(
                                    '/(' . preg_quote($search_query, '/') . ')/i',
                                    '<mark>$1</mark>',
                                    $excerpt
                                );
                                echo $highlighted;
                                ?>
                            </div>
                            
                            <!-- تاریخ -->
                            <div class="result-meta">
                                <span class="result-date">
                                    <i class="far fa-calendar"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                
                                <?php if ($post_type === 'post') : ?>
                                    <span class="result-category">
                                        <i class="far fa-folder"></i>
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        }
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- صفحه‌بندی -->
                <div class="search-pagination">
                    <?php
                    the_posts_pagination([
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-right"></i> قبلی',
                        'next_text' => 'بعدی <i class="fas fa-chevron-left"></i>',
                        'screen_reader_text' => 'نتایج جستجو'
                    ]);
                    ?>
                </div>
                
            <?php else : ?>
                <!-- هیچ نتیجه‌ای یافت نشد -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search fa-4x"></i>
                    </div>
                    
                    <h3>نتیجه‌ای یافت نشد</h3>
                    <p>متأسفانه هیچ نتیجه‌ای برای جستجوی شما یافت نشد. لطفاً:</p>
                    
                    <ul class="suggestions">
                        <li>املا و تایپ کلمات را بررسی کنید</li>
                        <li>از کلمات کلیدی عمومی‌تر استفاده کنید</li>
                        <li>کلمات کلیدی کمتری وارد کنید</li>
                        <li>در بخش‌های دیگر سایت جستجو کنید</li>
                    </ul>
                    
                    <div class="search-actions">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                            بازگشت به صفحه اصلی
                        </a>
                        <button class="btn btn-outline" id="show-search-tips">
                            نکات جستجوی پیشرفته
                        </button>
                    </div>
                    
                    <!-- نکات جستجو -->
                    <div class="search-tips" id="search-tips" style="display: none;">
                        <h4>نکات جستجوی پیشرفته:</h4>
                        <ul>
                            <li>استفاده از <strong>"علامت نقل قول"</strong> برای جستجوی عبارت دقیق</li>
                            <li>استفاده از <strong>OR</strong> برای جستجوی یکی از کلمات</li>
                            <li>استفاده از <strong>-</strong> قبل از کلمه برای حذف آن از نتایج</li>
                            <li>استفاده از <strong>*</strong> برای جستجوی کلمات مشابه</li>
                        </ul>
                    </div>
                </div>
                
                <!-- پیشنهادات -->
                <div class="search-suggestions">
                    <h4>شاید به این‌ها علاقه داشته باشید:</h4>
                    
                    <div class="suggested-posts">
                        <?php
                        $popular_posts = new WP_Query([
                            'posts_per_page' => 4,
                            'orderby' => 'comment_count',
                            'order' => 'DESC'
                        ]);
                        
                        if ($popular_posts->have_posts()) :
                            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                ?>
                                <div class="suggested-post">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" class="suggested-thumbnail">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <div class="suggested-content">
                                        <h5>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h5>
                                        <div class="suggested-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 10); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // نمایش نکات جستجو
    $('#show-search-tips').on('click', function() {
        $('#search-tips').slideToggle();
        $(this).text(function(i, text) {
            return text === 'نکات جستجوی پیشرفته' ? 'بستن نکات' : 'نکات جستجوی پیشرفته';
        });
    });
    
    // فوکوس روی فیلد جستجو
    $('.search-form-container input[type="search"]').focus();
    
    // هایلایت کلمات در نتایج
    var searchTerm = '<?php echo esc_js($search_query); ?>';
    if (searchTerm) {
        $('.result-title, .result-excerpt').each(function() {
            var text = $(this).html();
            var highlighted = text.replace(
                new RegExp(searchTerm, 'gi'),
                '<mark>$&</mark>'
            );
            $(this).html(highlighted);
        });
    }
});
</script>

<?php get_footer(); ?>