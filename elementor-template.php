<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page, post
 * 
 * تمپلیت کامل المنتور بدون سایدبار
 */

// Check if page is built with Elementor
$is_elementor_page = false;
if (class_exists('Elementor\Plugin')) {
    $is_elementor_page = \Elementor\Plugin::$instance->db->is_built_with_elementor(get_the_ID());
}

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        if ($is_elementor_page) {
            // Display Elementor content
            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(get_the_ID());
        } else {
            // Display normal content
            ?>
            <div class="elementor-template-wrapper">
                <div class="container">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>
                        
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
            </div>
            <?php
        }
    endwhile;
endif;

get_footer();