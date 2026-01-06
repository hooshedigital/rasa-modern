<?php
/**
 * Rasa System v3.5 - Archive Template
 * 
 * تمپلیت آرشیوها (دسته‌بندی‌ها، تگ‌ها، نویسنده، تاریخ)
 */

get_header();

// اطلاعات آرشیو
$archive_title = '';
$archive_description = '';

if (is_category()) {
    $archive_title = single_cat_title('', false);
    $archive_description = category_description();
} elseif (is_tag()) {
    $archive_title = single_tag_title('', false);
    $archive_description = tag_description();
} elseif (is_author()) {
    $archive_title = get_the_author();
    $archive_description = get_the_author_meta('description');
} elseif (is_date()) {
    if (is_year()) {
        $archive_title = get_the_date('Y');
        $archive_description = 'آرشیو سال ' . get_the_date('Y');
    } elseif (is_month()) {
        $archive_title = get_the_date('F Y');
        $archive_description = 'آرشیو ماه ' . get_the_date('F Y');
    } elseif (is_day()) {
        $archive_title = get_the_date();
        $archive_description = 'آرشیو روز ' . get_the_date();
    }
} elseif (is_post_type_archive()) {
    $archive_title = post_type_archive_title('', false);
    $archive_description = get_the_archive_description();
} else {
    $archive_title = get_the_archive_title();
    $archive_description = get_the_archive_description();
}
?>

<div class="archive-page-wrapper">
    <div class="container">
        <!-- هدر آرشیو -->
        <header class="archive-header">
            <h1 class="archive-title"><?php echo $archive_title; ?></h1>
            
            <?php if ($archive_description) : ?>
                <div class="archive-description">
                    <?php echo wpautop($archive_description); ?>
                </div>
            <?php endif; ?>
            
            <!-- آمار آرشیو -->
            <div class="archive-stats">
                <?php
                global $wp_query;
                $total_posts = $wp_query->found_posts;
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_per_page = get_option('posts_per_page');
                $start = (($paged - 1) * $posts_per_page) + 1;
                $end = min($start + $posts_per_page - 1, $total_posts);
                ?>
                <p>
                    نمایش 
                    <strong><?php echo $start; ?>-<?php echo $end; ?></strong> 
                    از <strong><?php echo $total_posts; ?></strong> 
                    مطلب
                </p>
            </div>
        </header>
        
        <!-- فیلترها -->
        <?php if (is_category() || is_tag() || is_post_type_archive('product')) : ?>
            <div class="archive-filters">
                <div class="filter-dropdown">
                    <select id="archive-sort" class="form-select">
                        <option value="date-desc">جدیدترین</option>
                        <option value="date-asc">قدیمی‌ترین</option>
                        <option value="title-asc">عنوان (الف-ی)</option>
                        <option value="title-desc">عنوان (ی-الف)</option>
                        <option value="comment-desc">پربحث‌ترین</option>
                    </select>
                </div>
                
                <div class="filter-view">
                    <button class="view-btn active" data-view="grid" aria-label="نمایش شبکه‌ای">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="view-btn" data-view="list" aria-label="نمایش لیستی">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- محتوای آرشیو -->
        <div class="archive-content">
            <?php if (have_posts()) : ?>
                <div class="posts-grid" id="posts-container">
                    <?php
                    while (have_posts()) : the_post();
                        ?>
                        <article <?php post_class('post-card'); ?>>
                            <!-- تصویر شاخص -->
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <?php
                                    the_post_thumbnail('medium', [
                                        'class' => 'img-fluid',
                                        'loading' => 'lazy'
                                    ]);
                                    ?>
                                    
                                    <!-- دسته‌بندی روی تصویر -->
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="post-category-badge">' . esc_html($categories[0]->name) . '</span>';
                                    }
                                    ?>
                                </a>
                            <?php endif; ?>
                            
                            <!-- محتوای پست -->
                            <div class="post-content">
                                <!-- متادیتا -->
                                <div class="post-meta">
                                    <span class="post-date">
                                        <i class="far fa-calendar"></i>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <?php if (comments_open()) : ?>
                                        <span class="post-comments">
                                            <i class="far fa-comment"></i>
                                            <?php comments_number('0', '1', '%'); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- عنوان -->
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <!-- خلاصه -->
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                </div>
                                
                                <!-- خواندن ادامه -->
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    ادامه مطلب <i class="fas fa-arrow-left"></i>
                                </a>
                                
                                <!-- نویسنده -->
                                <div class="post-author">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 30); ?>
                                    <span><?php the_author(); ?></span>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>
                
                <!-- صفحه‌بندی -->
                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination([
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-right"></i> قبلی',
                        'next_text' => 'بعدی <i class="fas fa-chevron-left"></i>',
                        'screen_reader_text' => 'صفحه‌بندی',
                        'aria_label' => 'پست‌ها',
                        'class' => 'pagination'
                    ]);
                    ?>
                </div>
                
            <?php else : ?>
                <!-- هیچ مطلبی یافت نشد -->
                <div class="no-posts-found">
                    <i class="far fa-folder-open fa-4x"></i>
                    <h3>هیچ مطلبی یافت نشد</h3>
                    <p>متأسفانه هیچ مطلبی در این بخش وجود ندارد.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        بازگشت به صفحه اصلی
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- سایدبار آرشیو -->
        <?php if (is_active_sidebar('archive-sidebar')) : ?>
            <aside class="archive-sidebar">
                <?php dynamic_sidebar('archive-sidebar'); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // تغییر نمای پست‌ها
    $('.view-btn').on('click', function() {
        var view = $(this).data('view');
        
        $('.view-btn').removeClass('active');
        $(this).addClass('active');
        
        $('#posts-container').removeClass('grid-view list-view').addClass(view + '-view');
        
        // ذخیره در localStorage
        localStorage.setItem('archive_view', view);
    });
    
    // بارگذاری نمای ذخیره شده
    var savedView = localStorage.getItem('archive_view') || 'grid';
    $('[data-view="' + savedView + '"]').click();
    
    // مرتب‌سازی پست‌ها
    $('#archive-sort').on('change', function() {
        var sort = $(this).val();
        var url = new URL(window.location.href);
        
        url.searchParams.set('sort', sort);
        window.location.href = url.toString();
    });
});
</script>

<?php get_footer(); ?>