<?php
/**
 * Rasa System v3.5 - Page Template
 * 
 * تمپلیت صفحات عادی - پشتیبانی از Elementor
 */

get_header();

// چک کردن آیا صفحه با المنتور ساخته شده
$is_elementor_page = false;

if (class_exists('Elementor\Plugin')) {
    $is_elementor_page = Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID());
}

if ($is_elementor_page) {
    // اگر صفحه با المنتور ساخته شده باشد
    echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display(get_the_ID());
} else {
    // محتوای عادی وردپرس
    ?>
    <div class="page-content-wrapper">
        <div class="container">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="page-header">
                            <?php
                            the_title('<h1 class="page-title">', '</h1>');
                            
                            if (has_post_thumbnail()) :
                                ?>
                                <div class="page-featured-image">
                                    <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
                                </div>
                                <?php
                            endif;
                            ?>
                        </header>
                        
                        <div class="page-content">
                            <?php the_content(); ?>
                            
                            <?php
                            wp_link_pages([
                                'before' => '<div class="page-links">' . esc_html__('صفحات:', 'rasa-system'),
                                'after'  => '</div>',
                            ]);
                            ?>
                        </div>
                        
                        <?php if (comments_open() || get_comments_number()) : ?>
                            <footer class="page-footer">
                                <?php comments_template(); ?>
                            </footer>
                        <?php endif; ?>
                    </article>
                    <?php
                endwhile;
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>
        </div>
    </div>
    <?php
}

get_footer();