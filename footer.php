<?php
/**
 * Rasa System v3.5 - Footer with Correct Elementor Support
 */

// چک ساده برای فوتر المنتور
$has_elementor_footer = false;

if (defined('ELEMENTOR_PRO_VERSION') && function_exists('elementor_theme_do_location')) {
    ob_start();
    elementor_theme_do_location('footer');
    $footer_output = ob_get_clean();
    
    if (!empty(trim($footer_output))) {
        $has_elementor_footer = true;
        echo $footer_output;
        wp_footer();
        echo '</body></html>';
        return;
    }
}
?>

</main><!-- .site-content -->

<!-- Back to Top Button -->
<a href="#" class="back-to-top" aria-label="بازگشت به بالا">
    <i class="fas fa-chevron-up"></i>
</a>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content container">
        <!-- About Company -->
        <div class="footer-section">
            <div class="footer-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
                    <span class="footer-logo-text">رسا سیستم</span>
                    <span class="footer-logo-subtitle">پیشرو در راهکارهای سازمانی</span>
                </a>
            </div>
            <p class="footer-description">
                ارائه‌دهنده راهکارهای نرم‌افزاری مالی و سازمانی با بیش از ۱۵ سال تجربه.
            </p>
            
            <div class="footer-social">
                <h4>ما را دنبال کنید</h4>
                <div class="social-links">
                    <a href="https://rasa99.ir" target="_blank" rel="noopener" class="social-link" aria-label="وبسایت">
                        <i class="fas fa-globe"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="اینستاگرام">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="لینکدین">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Quick Links -->
        <div class="footer-section">
            <h4>لینک‌های سریع</h4>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'menu_class'     => 'footer-links',
                'container'      => false,
                'depth'          => 1,
                'fallback_cb'    => function() {
                    echo '<ul class="footer-links">';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">خانه</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/about')) . '">درباره ما</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/contact')) . '">تماس با ما</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/blog')) . '">مقالات</a></li>';
                    echo '</ul>';
                },
            ]);
            ?>
        </div>
        
        <!-- Contact Info -->
        <div class="footer-section">
            <h4>اطلاعات تماس</h4>
            <ul class="contact-list">
                <li>
                    <i class="fas fa-phone"></i>
                    <span><?php echo esc_html(get_option('rasa_main_phone', '0912-870-2124')); ?></span>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <span><?php echo esc_html(get_option('rasa_main_email', 'info@rasasystemco.com')); ?></span>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?php echo esc_html(get_option('rasa_main_address', 'تهران، خیابان ولیعصر')); ?></span>
                </li>
                <li>
                    <i class="fas fa-clock"></i>
                    <span><?php echo esc_html(get_option('rasa_working_hours', 'شنبه تا چهارشنبه: ۸:۰۰ - ۱۷:۰۰')); ?></span>
                </li>
            </ul>
        </div>
        
        <!-- Newsletter -->
        <div class="footer-section">
            <h4>خبرنامه</h4>
            <p>با عضویت در خبرنامه، از جدیدترین محصولات و اخبار مطلع شوید.</p>
            <form class="newsletter-form" id="footer-newsletter">
                <input type="email" placeholder="آدرس ایمیل شما" required>
                <button type="submit" aria-label="عضویت در خبرنامه">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="footer-bottom">
        <div class="footer-bottom-content container">
            <div class="copyright">
                <p>© <?php echo date('Y'); ?> کلیه حقوق متعلق به شرکت <strong>رسا سیستم</strong> می‌باشد.</p>
            </div>
            
            <div class="footer-developer">
                <p>طراحی و توسعه: پارسا فانی و خشایار بهمنش</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll Indicator -->
<div class="scroll-indicator">
    <div class="scroll-dot active" data-section="خانه"></div>
    <div class="scroll-dot" data-section="درباره"></div>
    <div class="scroll-dot" data-section="محصولات"></div>
</div>

<?php wp_footer(); ?>

</body>
</html>