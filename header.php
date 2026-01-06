<?php
/**
 * Rasa System v3.5 - Header with Correct Elementor Support
 * 
 * هدر کامل با پشتیبانی درست از Elementor Theme Builder
 */

// چک صحیح وجود هدر المنتور - روش ساده و مطمئن
$has_elementor_header = false;

// روش ساده و بدون خطا برای چک کردن المنتور
if (defined('ELEMENTOR_PRO_VERSION') && function_exists('elementor_theme_do_location')) {
    // روش 1: استفاده از elementor_theme_do_location با output buffering
    ob_start();
    elementor_theme_do_location('header');
    $elementor_header_content = ob_get_clean();
    
    // اگر محتوایی تولید شده باشد، یعنی هدر المنتور وجود دارد
    if (!empty(trim($elementor_header_content))) {
        $has_elementor_header = true;
        
        // نمایش هدر المنتور و خروج
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?> dir="rtl">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="profile" href="https://gmpg.org/xfn/11">
            <?php wp_head(); ?>
        </head>
        <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php echo $elementor_header_content; ?>
        <?php return; // خروج - بقیه کدها اجرا نشود ?>
        <?php
    }
}

// روش 2: چک با فیلتر (اگر روش اول کار نکرد)
if (!$has_elementor_header && defined('ELEMENTOR_PRO_VERSION')) {
    $has_elementor_header = apply_filters('rasa_has_elementor_header', false);
}

// اگر هدر المنتور وجود داشته باشد و محتوا داشته باشد
if ($has_elementor_header && function_exists('elementor_theme_do_location')) {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?> dir="rtl">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php elementor_theme_do_location('header'); ?>
    <?php return; // خروج - بقیه کدها اجرا نشود ?>
    <?php
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl" data-theme="dark">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
    <?php
    // SEO Meta Tags
    if (is_front_page()) {
        echo '<meta name="description" content="رسا سیستم - ارائه‌دهنده راهکارهای نرم‌افزاری مالی و سازمانی">';
        echo '<meta name="keywords" content="نرم افزار حسابداری, سیستم انبارداری, مدیریت منابع انسانی">';
        echo '<meta property="og:title" content="رسا سیستم - راهکارهای نرم‌افزاری مالی و سازمانی">';
        echo '<meta property="og:description" content="ارائه‌دهنده سامانه‌های تخصصی برای مدیریت مالی">';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">';
    }
    ?>
    
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner"></div>
</div>

<!-- Header Top Bar -->
<div class="header-top-bar">
    <div class="container header-top-container">
        <div class="top-contact-info">
            <a href="tel:09128702124" class="phone-link">
                <i class="fas fa-phone"></i>
                <span class="phone-text">0912-870-2124</span>
            </a>
            <a href="mailto:<?php echo esc_attr(get_option('rasa_main_email', 'info@rasasystemco.com')); ?>" class="email-link">
                <i class="fas fa-envelope"></i>
                <span><?php echo esc_html(get_option('rasa_main_email', 'info@rasasystemco.com')); ?></span>
            </a>
        </div>
        
        <div class="top-social-links">
            <a href="https://rasa99.ir" target="_blank" rel="noopener"><i class="fas fa-globe"></i></a>
            <a href="#" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
            <a href="#" target="_blank" rel="noopener"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="site-header">
    <div class="container header-container">
        <div class="header-logo">
            <?php
            // نمایش لوگو یا متن
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                    <span class="logo-text">رسا سیستم</span>
                    <span class="logo-subtitle">راهکارهای سازمانی</span>
                </a>
                <?php
            }
            ?>
        </div>
        
        <nav class="main-navigation desktop-menu">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'container'      => false,
                'walker'         => new Rasa_Walker_Nav_Menu(),
                'fallback_cb'    => '__return_false',
            ]);
            ?>
        </nav>
        
        <div class="header-actions">
            <a href="tel:09128702124" class="phone-link">
                <i class="fas fa-phone"></i>
            </a>
            
            <div class="theme-switcher">
                <i class="fas fa-moon"></i>
            </div>
            
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu-wrapper" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="mobile-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <span>رسا سیستم</span>
            </a>
        </div>
        <button class="mobile-close" id="mobileClose" aria-label="بستن منو">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <nav class="mobile-navigation">
        <?php
        wp_nav_menu([
            'theme_location' => 'mobile',
            'menu_class'     => 'mobile-menu-list',
            'container'      => false,
            'fallback_cb'    => function() {
                // Fallback به منوی اصلی
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-menu-list',
                    'container'      => false,
                ]);
            },
        ]);
        ?>
    </nav>
    
    <div class="mobile-contact">
        <a href="tel:09128702124" class="mobile-phone">
            <i class="fas fa-phone"></i>
            <div>
                <span class="contact-label">تلفن</span>
                <span class="contact-value">0912-870-2124</span>
            </div>
        </a>
        
        <a href="mailto:<?php echo esc_attr(get_option('rasa_main_email', 'info@rasasystemco.com')); ?>" class="mobile-email">
            <i class="fas fa-envelope"></i>
            <div>
                <span class="contact-label">ایمیل</span>
                <span class="contact-value"><?php echo esc_html(get_option('rasa_main_email', 'info@rasasystemco.com')); ?></span>
            </div>
        </a>
        
        <div class="mobile-social">
            <a href="https://rasa99.ir" target="_blank" rel="noopener">
                <i class="fas fa-globe"></i>
            </a>
            <a href="#" target="_blank" rel="noopener">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" target="_blank" rel="noopener">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</div>

<div class="mobile-overlay" id="mobileOverlay"></div>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/989128702124" class="whatsapp-float" target="_blank" rel="noopener" aria-label="واتساپ">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Floating Elements -->
<div class="hero-floating-elements">
    <div class="floating-element" style="top: 10%; right: 5%; width: 60px; height: 60px;"></div>
    <div class="floating-element" style="top: 30%; left: 10%; width: 40px; height: 40px;"></div>
</div>

<!-- Particle Container -->
<?php if (is_front_page()) : ?>
    <div id="particles-js"></div>
<?php endif; ?>

<main class="site-content" id="main-content">