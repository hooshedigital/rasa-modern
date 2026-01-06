<?php
/**
 * Rasa System v3.5 - Main Template
 * 
 * این تمپلیت اصلی برای یکپارچه شدن با Elementor
 */

get_header();

// چک کردن آیا صفحه اصلی است
if (is_front_page()) {
    
    // چک کردن آیا تمپلیت المنتور برای صفحه اصلی تنظیم شده
    $elementor_homepage = get_option('rasa_elementor_homepage', '');
    
    if ($elementor_homepage && class_exists('Elementor\Plugin')) {
        // نمایش تمپلیت المنتور
        echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($elementor_homepage);
    } else {
        // محتوای پیش‌فرض صفحه اصلی
        ?>
        <!-- ========== HERO SECTION ========== -->
        <section class="hero-section hero-enhanced">
            <div class="hero-content">
                <h1 class="hero-title text-reveal">
                    <span class="highlight">راهکارهای نرم‌افزاری</span>
                    <span>مالی و سازمانی حرفه‌ای</span>
                </h1>
                <p class="hero-description">
                    ارائه‌دهنده سامانه‌های تخصصی برای مدیریت مالی، حسابداری، 
                    منابع انسانی و اتوماسیون فرآیندهای سازمانی با بیش از ۱۵ سال تجربه
                </p>
                <div class="hero-buttons">
                    <a href="#products" class="btn btn-primary hover-3d">
                        <i class="fas fa-eye"></i>
                        مشاهده محصولات
                    </a>
                    <a href="#contact" class="btn btn-outline hover-3d">
                        <i class="fas fa-headset"></i>
                        درخواست مشاوره رایگان
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">50+</span>
                        <span class="hero-stat-label">پروژه موفق</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">15+</span>
                        <span class="hero-stat-label">سال تجربه</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">100+</span>
                        <span class="hero-stat-label">مشتری راضی</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-shape"></div>
            </div>
        </section>

        <!-- ========== ABOUT SECTION ========== -->
        <section class="section about-section animate-on-scroll" id="about">
            <div class="section-header">
                <h2 class="section-title">درباره <span class="highlight">رسا سیستم</span></h2>
                <p class="section-subtitle">پیشرو در ارائه راهکارهای یکپارچه سازمانی</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <p>
                        <strong>شرکت رسا سیستم</strong> با بیش از یک دهه تجربه در حوزه نرم‌افزارهای سازمانی، 
                        ارائه‌دهنده راهکارهای جامع برای مدیریت مالی، حسابداری، انبارداری، 
                        منابع انسانی و اتوماسیون فرآیندهای کسب‌وکار می‌باشد.
                    </p>
                    <p>
                        ما با تیمی متخصص و به‌روزترین تکنولوژی‌ها، سامانه‌های نرم‌افزاری را 
                        متناسب با نیازهای خاص هر سازمان طراحی و توسعه می‌دهیم.
                    </p>
                    <div class="about-features stagger-animate">
                        <div class="feature-item glass-card hover-3d">
                            <i class="fas fa-chart-line"></i>
                            <span>بهبود فرآیندها تا ۷۰٪</span>
                        </div>
                        <div class="feature-item glass-card hover-3d">
                            <i class="fas fa-shield-alt"></i>
                            <span>امنیت سطح سازمانی</span>
                        </div>
                        <div class="feature-item glass-card hover-3d">
                            <i class="fas fa-headset"></i>
                            <span>پشتیبانی ۲۴/۷</span>
                        </div>
                        <div class="feature-item glass-card hover-3d">
                            <i class="fas fa-sync-alt"></i>
                            <span>بروزرسانی دائمی</span>
                        </div>
                    </div>
                </div>
                <div class="about-stats animated-gradient-bg">
                    <div class="stat-item">
                        <span class="stat-number" data-count="50">0</span>
                        <span class="stat-label">پروژه موفق</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="15">0</span>
                        <span class="stat-label">سال تجربه</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="100">0</span>
                        <span class="stat-label">مشتری راضی</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="24">0</span>
                        <span class="stat-label">ساعت پشتیبانی</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== SERVICES SHOWCASE ========== -->
        <section class="section services-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">خدمات <span class="highlight">تخصصی</span> ما</h2>
                <p class="section-subtitle">راهکارهای جامع برای مدیریت هوشمند کسب‌وکار</p>
            </div>
            <div class="services-showcase">
                <div class="service-card hover-3d">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="service-title">توسعه نرم‌افزار سفارشی</h3>
                    <p class="service-description">
                        طراحی و توسعه نرم‌افزارهای سازمانی متناسب با نیازهای خاص هر کسب‌وکار با استفاده از تکنولوژی‌های روز دنیا
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> تحلیل نیازهای کسب‌وکار</li>
                        <li><i class="fas fa-check"></i> طراحی UX/UI حرفه‌ای</li>
                        <li><i class="fas fa-check"></i> توسعه با آخرین تکنولوژی‌ها</li>
                    </ul>
                    <a href="#" class="btn btn-outline">مشاهده جزئیات</a>
                </div>
                
                <div class="service-card hover-3d">
                    <div class="service-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3 class="service-title">راه‌حل‌های ابری</h3>
                    <p class="service-description">
                        ارائه سرویس‌های ابری امن و مقیاس‌پذیر برای دسترسی از هر مکان و هر دستگاه
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> میزبانی امن</li>
                        <li><i class="fas fa-check"></i> پشتیبان‌گیری خودکار</li>
                        <li><i class="fas fa-check"></i> مقیاس‌پذیری بالا</li>
                    </ul>
                    <a href="#" class="btn btn-outline">مشاهده جزئیات</a>
                </div>
                
                <div class="service-card hover-3d">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="service-title">اپلیکیشن موبایل</h3>
                    <p class="service-description">
                        توسعه اپلیکیشن‌های موبایل برای iOS و Android با رابط کاربری جذاب و عملکرد عالی
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> توسعه Native & Hybrid</li>
                        <li><i class="fas fa-check"></i> بهینه‌سازی عملکرد</li>
                        <li><i class="fas fa-check"></i> انتشار در مارکت‌ها</li>
                    </ul>
                    <a href="#" class="btn btn-outline">مشاهده جزئیات</a>
                </div>
            </div>
        </section>

        <!-- ========== PRODUCTS SECTION ========== -->
        <section class="section products-section animate-on-scroll" id="products">
            <div class="section-header">
                <h2 class="section-title">محصولات و <span class="highlight">راهکارها</span></h2>
                <p class="section-subtitle">سامانه‌های تخصصی برای هر بخش سازمان</p>
            </div>
            <div class="products-grid stagger-animate">
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-badge">پرفروش</div>
                    <div class="product-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="product-title">نرم‌افزار حسابداری</h3>
                    <p class="product-description">
                        سیستم جامع مالی و حسابداری با قابلیت‌های پیشرفته گزارش‌گیری، 
                        پرداخت حقوق و دستمزد، اظهارنامه مالیاتی و مدیریت تراکنش‌های بانکی
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> صدور فاکتور و صورتحساب</li>
                        <li><i class="fas fa-check"></i> مدیریت حساب‌های بانکی</li>
                        <li><i class="fas fa-check"></i> گزارش‌های تحلیلی مالی</li>
                        <li><i class="fas fa-check"></i> اظهارنامه مالیاتی</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
                
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-badge">جدید</div>
                    <div class="product-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h3 class="product-title">سیستم انبارداری</h3>
                    <p class="product-description">
                        مدیریت هوشمند انبار، کنترل موجودی، صدور حواله انبار، 
                        انبارگردانی و گزارش‌گیری لحظه‌ای با قابلیت بارکدخوانی
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> مدیریت چند انباری</li>
                        <li><i class="fas fa-check"></i> سیستم بارکدخوانی</li>
                        <li><i class="fas fa-check"></i> کنترل سطح سفارش</li>
                        <li><i class="fas fa-check"></i> گزارش موجودی لحظه‌ای</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
                
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="product-title">منابع انسانی</h3>
                    <p class="product-description">
                        سامانه مدیریت پرسنلی، حضور و غیاب، مرخصی‌ها، 
                        حقوق و دستمزد و ارزیابی عملکرد کارکنان
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> سیستم حضور و غیاب</li>
                        <li><i class="fas fa-check"></i> محاسبه حقوق و مزایا</li>
                        <li><i class="fas fa-check"></i> مدیریت مرخصی و مأموریت</li>
                        <li><i class="fas fa-check"></i> ارزیابی عملکرد</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
                
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="product-title">تحلیل و گزارش‌گیری</h3>
                    <p class="product-description">
                        داشبوردهای مدیریتی، گزارش‌های تحلیلی، 
                        نمودارهای تعاملی و آنالیز داده‌های سازمانی
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> داشبوردهای مدیریتی</li>
                        <li><i class="fas fa-check"></i> گزارش‌های سفارشی</li>
                        <li><i class="fas fa-check"></i> نمودارهای تعاملی</li>
                        <li><i class="fas fa-check"></i> آنالیز پیشرفته</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
                
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="product-title">فروش و CRM</h3>
                    <p class="product-description">
                        سیستم مدیریت ارتباط با مشتریان، پیگیری فروش، 
                        مدیریت سفارشات و تحلیل رفتار مشتریان
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> مدیریت مشتریان</li>
                        <li><i class="fas fa-check"></i> پیگیری فرصت‌های فروش</li>
                        <li><i class="fas fa-check"></i> مدیریت سفارشات</li>
                        <li><i class="fas fa-check"></i> گزارش‌های بازاریابی</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
                
                <div class="product-card product-card-enhanced hover-3d">
                    <div class="product-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="product-title">اتوماسیون اداری</h3>
                    <p class="product-description">
                        سیستم مدیریت گردش کار، پیگیری نامه‌ها، 
                        بایگانی اسناد و مدیریت جلسات و تصمیم‌گیری‌ها
                    </p>
                    <ul class="product-features">
                        <li><i class="fas fa-check"></i> گردش کار الکترونیک</li>
                        <li><i class="fas fa-check"></i> مدیریت نامه‌ها</li>
                        <li><i class="fas fa-check"></i> بایگانی اسناد</li>
                        <li><i class="fas fa-check"></i> مدیریت جلسات</li>
                    </ul>
                    <a href="#" class="product-link">اطلاعات بیشتر <i class="fas fa-arrow-left"></i></a>
                </div>
            </div>
        </section>

        <!-- ========== TEAM SECTION ========== -->
        <section class="section team-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">تیم <span class="highlight">متخصص</span> ما</h2>
                <p class="section-subtitle">با تجربه‌ترین مهندسان و مشاوران در کنار شما</p>
            </div>
            <div class="team-grid stagger-animate">
                <div class="team-member hover-3d">
                    <div class="member-image">
                    <img src="https://via.placeholder.com/400x400/E63946/ffffff?text=پارسا+فانی" alt="پارسا فانی" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">پارسا فانی</h3>
                        <span class="member-position">مدیر فنی و بنیان‌گذار</span>
                        <p class="member-bio">
                            با بیش از ۱۲ سال تجربه در توسعه سیستم‌های سازمانی و مدیریت پروژه‌های نرم‌افزاری
                        </p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member hover-3d">
                    <div class="member-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team2.jpg" alt="خشایار بهمنش" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">خشایار بهمنش</h3>
                        <span class="member-position">مدیر بازاریابی و فروش</span>
                        <p class="member-bio">
                            متخصص در راهکارهای دیجیتال مارکتینگ و مدیریت ارتباط با مشتریان سازمانی
                        </p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member hover-3d">
                    <div class="member-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team3.jpg" alt="مهندس کریمی" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">مهندس کریمی</h3>
                        <span class="member-position">توسعه‌دهنده ارشد</span>
                        <p class="member-bio">
                            متخصص در حوزه امنیت نرم‌افزار و توسعه سیستم‌های ابری با ۸ سال سابقه
                        </p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                            <a href="#"><i class="fab fa-stack-overflow"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="team-member hover-3d">
                    <div class="member-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team4.jpg" alt="دکتر رضایی" loading="lazy">
                    </div>
                    <div class="member-info">
                        <h3 class="member-name">دکتر رضایی</h3>
                        <span class="member-position">مشاور فنی</span>
                        <p class="member-bio">
                            دکترای مهندسی نرم‌افزار و مشاور در زمینه معماری سیستم‌های سازمانی
                        </p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-graduation-cap"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== PROJECTS SECTION ========== -->
        <section class="section projects-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">پروژه‌های <span class="highlight">موفق</span></h2>
                <p class="section-subtitle">نمونه‌کارهای اجرا شده برای سازمان‌های مختلف</p>
            </div>
            
            <div class="project-filter">
                <button class="filter-btn active" data-filter="all">همه پروژه‌ها</button>
                <button class="filter-btn" data-filter="financial">سیستم‌های مالی</button>
                <button class="filter-btn" data-filter="hr">منابع انسانی</button>
                <button class="filter-btn" data-filter="inventory">انبارداری</button>
                <button class="filter-btn" data-filter="custom">سفارشی</button>
            </div>
            
            <div class="projects-showcase">
                <div class="project-card hover-3d" data-category="financial">
                    <div class="project-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project1.jpg" alt="سیستم بانکی" loading="lazy">
                        <div class="project-overlay">
                            <a href="#" class="btn btn-primary">مشاهده جزئیات</a>
                        </div>
                        <div class="project-tags">
                            <span class="project-tag">مالی</span>
                            <span class="project-tag">بانکی</span>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">سیستم مدیریت بانکی</h3>
                        <p class="project-description">
                            پیاده‌سازی سامانه جامع مالی برای یکی از بانک‌های خصوصی کشور با قابلیت مدیریت چند شعبه و گزارش‌گیری لحظه‌ای
                        </p>
                        <div class="project-stats">
                            <span><i class="far fa-clock"></i> ۶ ماه</span>
                            <span><i class="fas fa-users"></i> ۵۰+ کاربر</span>
                            <span><i class="fas fa-chart-line"></i> ۴۰٪ بهبود</span>
                        </div>
                    </div>
                </div>
                
                <div class="project-card hover-3d" data-category="hr">
                    <div class="project-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project2.jpg" alt="سیستم درمانی" loading="lazy">
                        <div class="project-overlay">
                            <a href="#" class="btn btn-primary">مشاهده جزئیات</a>
                        </div>
                        <div class="project-tags">
                            <span class="project-tag">درمانی</span>
                            <span class="project-tag">منابع انسانی</span>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">سیستم بیمارستانی</h3>
                        <p class="project-description">
                            توسعه سامانه مدیریت بیمارستان برای مراکز درمانی سطح یک با سیستم حضور و غیاب و محاسبه حقوق پرسنل
                        </p>
                        <div class="project-stats">
                            <span><i class="far fa-clock"></i> ۸ ماه</span>
                            <span><i class="fas fa-users"></i> ۲۰۰+ کاربر</span>
                            <span><i class="fas fa-chart-line"></i> ۶۰٪ بهبود</span>
                        </div>
                    </div>
                </div>
                
                <div class="project-card hover-3d" data-category="inventory">
                    <div class="project-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project3.jpg" alt="سیستم انبارداری" loading="lazy">
                        <div class="project-overlay">
                            <a href="#" class="btn btn-primary">مشاهده جزئیات</a>
                        </div>
                        <div class="project-tags">
                            <span class="project-tag">انبارداری</span>
                            <span class="project-tag">صنعتی</span>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">سیستم انبارداری صنعتی</h3>
                        <p class="project-description">
                            طراحی سیستم مدیریت انبار برای یک مجموعه تولیدی بزرگ با قابلیت بارکدخوانی و کنترل موجودی لحظه‌ای
                        </p>
                        <div class="project-stats">
                            <span><i class="far fa-clock"></i> ۴ ماه</span>
                            <span><i class="fas fa-users"></i> ۳۰+ کاربر</span>
                            <span><i class="fas fa-chart-line"></i> ۵۵٪ بهبود</span>
                        </div>
                    </div>
                </div>
                
                <div class="project-card hover-3d" data-category="custom">
                    <div class="project-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/project4.jpg" alt="اپ موبایل" loading="lazy">
                        <div class="project-overlay">
                            <a href="#" class="btn btn-primary">مشاهده جزئیات</a>
                        </div>
                        <div class="project-tags">
                            <span class="project-tag">موبایل</span>
                            <span class="project-tag">CRM</span>
                        </div>
                    </div>
                    <div class="project-info">
                        <h3 class="project-title">اپلیکیشن مدیریت فروش</h3>
                        <p class="project-description">
                            توسعه اپلیکیشن موبایل برای مدیریت فروش و CRM یک شرکت بازرگانی با قابلیت آفلاین
                        </p>
                        <div class="project-stats">
                            <span><i class="far fa-clock"></i> ۳ ماه</span>
                            <span><i class="fas fa-users"></i> ۱۰۰+ کاربر</span>
                            <span><i class="fas fa-chart-line"></i> ۳۵٪ افزایش فروش</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== COMPARISON TABLE ========== -->
        <section class="section comparison-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">مقایسه <span class="highlight">پلن‌ها</span></h2>
                <p class="section-subtitle">انتخاب پلن مناسب برای سازمان شما</p>
            </div>
            <div class="comparison-table-container">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>ویژگی‌ها</th>
                            <th>
                                <div>پلن پایه</div>
                                <div class="price-cell">۲۹۰,۰۰۰ تومان</div>
                                <div class="price-period">ماهیانه</div>
                            </th>
                            <th>
                                <div>پلن حرفه‌ای</div>
                                <div class="price-cell">۵۹۰,۰۰۰ تومان</div>
                                <div class="price-period">ماهیانه</div>
                            </th>
                            <th>
                                <div>پلن سازمانی</div>
                                <div class="price-cell">۱,۲۹۰,۰۰۰ تومان</div>
                                <div class="price-period">ماهیانه</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>مدیریت مالی و حسابداری</td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>سیستم انبارداری پیشرفته</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>منابع انسانی کامل</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>سیستم CRM</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>اتوماسیون اداری</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>پشتیبانی ۲۴/۷</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>اپ موبایل</td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-times times-icon"></i></td>
                            <td><i class="fas fa-check check-icon"></i></td>
                        </tr>
                        <tr>
                            <td>تعداد کاربران</td>
                            <td>تا ۵ کاربر</td>
                            <td>تا ۲۰ کاربر</td>
                            <td>نامحدود</td>
                        </tr>
                        <tr>
                            <td>ذخیره‌سازی داده</td>
                            <td>۱۰ گیگابایت</td>
                            <td>۵۰ گیگابایت</td>
                            <td>نامحدود</td>
                        </tr>
                        <tr>
                            <td>بروزرسانی</td>
                            <td>ماهیانه</td>
                            <td>هفتگی</td>
                            <td>روزانه</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a href="#contact" class="btn btn-outline">انتخاب پلن</a></td>
                            <td><a href="#contact" class="btn btn-primary">انتخاب پلن</a></td>
                            <td><a href="#contact" class="btn btn-primary btn-lg">انتخاب پلن</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ========== TESTIMONIALS SECTION ========== -->
        <section class="section testimonials-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">نظرات <span class="highlight">مشتریان</span></h2>
                <p class="section-subtitle">تجربه سازمان‌هایی که با ما همکاری کرده‌اند</p>
            </div>
            <div class="testimonials-slider stagger-animate">
                <div class="testimonial-card glass-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-content">
                        بعد از پیاده‌سازی سیستم حسابداری رسا سیستم، روند کارهای مالی ما ۶۰٪ سریع‌تر شده و خطاهای انسانی به حداقل رسیده است. پشتیبانی فوق‌العاده تیم فنی همیشه در دسترس است.
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar1.jpg" alt="مدیر مالی" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4>مهندس محمدرضا حسینی</h4>
                            <span>مدیر مالی شرکت صنعتی سپهر</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card glass-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-content">
                        سیستم انبارداری سفارشی که تیم رسا سیستم برای ما توسعه داد، مدیریت موجودی ۳ انبار ما را به طور کامل متحول کرد. گزارش‌گیری لحظه‌ای و قابلیت بارکدخوانی بسیار کاربردی است.
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar2.jpg" alt="مدیر انبار" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4>علیرضا محمدی</h4>
                            <span>مدیر لجستیک شرکت بازرگانی نیلوفر</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card glass-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-content">
                        نرم‌افزار منابع انسانی رسا سیستم به ما کمک کرد تا فرآیندهای پرسنلی را به طور کامل دیجیتالی کنیم. از محاسبه حقوق تا مدیریت مرخصی‌ها، همه چیز به صورت خودکار انجام می‌شود.
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar3.jpg" alt="مدیر منابع انسانی" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4>فاطمه رضوانی</h4>
                            <span>مدیر منابع انسانی بیمارستان مهر</span>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card glass-card">
                    <div class="testimonial-quote">"</div>
                    <p class="testimonial-content">
                        اپلیکیشن موبایلی که برای مدیریت فروش ما طراحی کردند، باعث افزایش ۳۵٪یی فروش ماهانه شده است. تیم فروش ما حالا می‌تواند از هر مکان با مشتریان در ارتباط باشد.
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar4.jpg" alt="مدیر فروش" loading="lazy">
                        </div>
                        <div class="author-info">
                            <h4>سعید کریمی</h4>
                            <span>مدیر فروش شرکت پخش آرین</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== CLIENTS SECTION ========== -->
        <section class="section clients-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">مشتریان <span class="highlight">رسا سیستم</span></h2>
                <p class="section-subtitle">همراهی سازمان‌های موفق در سراسر کشور</p>
            </div>
            <div class="clients-logos stagger-animate">
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client1.png" alt="شرکت تولیدی" loading="lazy">
                </div>
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client2.png" alt="شرکت بازرگانی" loading="lazy">
                </div>
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client3.png" alt="مراکز درمانی" loading="lazy">
                </div>
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client4.png" alt="سازمان‌های دولتی" loading="lazy">
                </div>
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client5.png" alt="شرکت‌های پیمانکاری" loading="lazy">
                </div>
                <div class="client-logo glass-card hover-3d">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client6.png" alt="بانک‌ها" loading="lazy">
                </div>
            </div>
        </section>

        <!-- ========== NEWSLETTER SECTION ========== -->
        <section class="section newsletter-section animate-on-scroll">
            <div class="section-header">
                <h2 class="section-title">در جریان <span class="highlight">به‌روزرسانی‌ها</span> باشید</h2>
                <p class="section-subtitle">جدیدترین مقالات و آموزش‌های حوزه نرم‌افزارهای سازمانی را دریافت کنید</p>
            </div>
            <form class="newsletter-form" id="newsletterForm">
                <input type="email" class="newsletter-input" placeholder="آدرس ایمیل خود را وارد کنید" required>
                <button type="submit" class="btn btn-primary hover-3d">
                    <i class="fas fa-paper-plane"></i>
                    عضویت در خبرنامه
                </button>
            </form>
            <p class="newsletter-note" style="margin-top: 1rem; color: var(--text-gray); font-size: 0.9rem;">
                با عضویت، موافقت خود با <a href="#" style="color: var(--primary-red);">سیاست‌های حریم خصوصی</a> را اعلام می‌کنید.
            </p>
        </section>

        <!-- ========== ADVANCED CONTACT FORM ========== -->
        <section class="section contact-section animate-on-scroll" id="contact">
            <div class="section-header">
                <h2 class="section-title">تماس با <span class="highlight">ما</span></h2>
                <p class="section-subtitle">برای دریافت مشاوره رایگان و اطلاعات بیشتر با ما در ارتباط باشید</p>
            </div>
            
            <div class="advanced-contact-form glass-card">
                <div class="form-grid">
                    <div class="contact-info-sidebar">
                        <h3 style="margin-bottom: 2rem; color: var(--text-light);">اطلاعات تماس</h3>
                        <div class="contact-details">
                            <div class="contact-item hover-3d">
                                <i class="fas fa-phone"></i>
                                <div class="contact-item-content">
                                    <h4>تلفن تماس</h4>
                                    <p><?php echo esc_html(get_option('rasa_main_phone', '۰۹۱۲-۸۷۰-۲۱۲۴')); ?></p>
                                    <p style="font-size: 0.9rem; color: var(--text-gray); margin-top: 0.3rem;">پاسخگویی همه روزه از ۸ صبح تا ۱۰ شب</p>
                                </div>
                            </div>
                            
                            <div class="contact-item hover-3d">
                                <i class="fas fa-envelope"></i>
                                <div class="contact-item-content">
                                    <h4>ایمیل</h4>
                                    <p><?php echo esc_html(get_option('rasa_main_email', 'info@rasasystemco.com')); ?></p>
                                    <p style="font-size: 0.9rem; color: var(--text-gray); margin-top: 0.3rem;">پاسخگویی در کمتر از ۲۴ ساعت</p>
                                </div>
                            </div>
                            
                            <div class="contact-item hover-3d">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="contact-item-content">
                                    <h4>آدرس دفتر مرکزی</h4>
                                    <p><?php echo esc_html(get_option('rasa_main_address', 'تهران، خیابان ولیعصر، پلاک ۱۲۳۴، طبقه ۵')); ?></p>
                                    <p style="font-size: 0.9rem; color: var(--text-gray); margin-top: 0.3rem;">شنبه تا چهارشنبه ۸:۰۰ - ۱۷:۰۰</p>
                                </div>
                            </div>
                            
                            <div class="contact-item hover-3d">
                                <i class="fas fa-clock"></i>
                                <div class="contact-item-content">
                                    <h4>ساعات کاری</h4>
                                    <p>شنبه تا چهارشنبه: ۸:۰۰ - ۱۷:۰۰</p>
                                    <p style="font-size: 0.9rem; color: var(--text-gray); margin-top: 0.3rem;">پنجشنبه‌ها: ۸:۰۰ - ۱۴:۰۰</p>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top: 3rem;">
                            <h4 style="margin-bottom: 1rem; color: var(--text-light);">پیوندهای سریع</h4>
                            <div class="footer-links">
                                <li><a href="#"><i class="fas fa-chevron-left"></i> درخواست دمو رایگان</a></li>
                                <li><a href="#"><i class="fas fa-chevron-left"></i> دانلود کاتالوگ</a></li>
                                <li><a href="#"><i class="fas fa-chevron-left"></i> سوالات متداول</a></li>
                                <li><a href="#"><i class="fas fa-chevron-left"></i> پشتیبانی آنلاین</a></li>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-form-container">
                        <h3 style="margin-bottom: 2rem; color: var(--text-light);">فرم درخواست مشاوره</h3>
                        <form class="contact-form" id="contactForm">
                            <div class="form-group">
                                <label for="name">نام و نام خانوادگی *</label>
                                <input type="text" id="name" class="form-control" placeholder="نام کامل خود را وارد کنید" required>
                            </div>
                            
                            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                <div class="form-group">
                                    <label for="phone">شماره تماس *</label>
                                    <input type="tel" id="phone" class="form-control" placeholder="مثال: ۰۹۱۲۱۲۳۴۵۶۷" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">آدرس ایمیل *</label>
                                    <input type="email" id="email" class="form-control" placeholder="example@domain.com" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="company">نام سازمان</label>
                                <input type="text" id="company" class="form-control" placeholder="نام شرکت یا سازمان شما">
                            </div>
                            
                            <div class="form-group">
                                <label for="service">نوع خدمات مورد نیاز *</label>
                                <select id="service" class="form-control" required>
                                    <option value="">لطفاً انتخاب کنید</option>
                                    <option value="accounting">نرم‌افزار حسابداری</option>
                                    <option value="inventory">سیستم انبارداری</option>
                                    <option value="hr">منابع انسانی</option>
                                    <option value="crm">سیستم CRM</option>
                                    <option value="automation">اتوماسیون اداری</option>
                                    <option value="custom">توسعه سفارشی</option>
                                    <option value="consulting">مشاوره</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="employees">تعداد پرسنل سازمان</label>
                                <select id="employees" class="form-control">
                                    <option value="">لطفاً انتخاب کنید</option>
                                    <option value="1-10">۱ تا ۱۰ نفر</option>
                                    <option value="11-50">۱۱ تا ۵۰ نفر</option>
                                    <option value="51-200">۵۱ تا ۲۰۰ نفر</option>
                                    <option value="201-500">۲۰۱ تا ۵۰۰ نفر</option>
                                    <option value="500+">بیش از ۵۰۰ نفر</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">پیام شما *</label>
                                <textarea id="message" class="form-control" placeholder="درخواست، سوال یا نیازهای خود را شرح دهید..." rows="5" required></textarea>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 2rem;">
                                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" required style="margin-top: 3px;">
                                    <span style="font-size: 0.9rem; color: var(--text-gray);">
                                        با <a href="#" style="color: var(--primary-red);">قوانین و مقررات</a> و <a href="#" style="color: var(--primary-red);">حریم خصوصی</a> موافقت می‌کنم.
                                    </span>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg hover-3d" style="width: 100%;">
                                <i class="fas fa-paper-plane"></i>
                                ارسال درخواست مشاوره
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== CTA SECTION ========== -->
        <section class="section cta-section animate-on-scroll">
            <div class="cta-content">
                <h2 class="cta-title">آماده تحول در مدیریت سازمان خود هستید؟</h2>
                <p class="cta-description">
                    برای دریافت مشاوره رایگان، دموی نرم‌افزار و اطلاعات بیشتر با ما تماس بگیرید
                </p>
                <div class="cta-contacts">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', get_option('rasa_main_phone', '09128702124'))); ?>" class="cta-phone glass-card hover-3d">
                        <i class="fas fa-phone"></i>
                        <div>
                            <span class="contact-label">تماس تلفنی</span>
                            <span class="contact-value"><?php echo esc_html(get_option('rasa_main_phone', '۰۹۱۲-۸۷۰-۲۱۲۴')); ?></span>
                        </div>
                    </a>
                    <a href="mailto:<?php echo esc_attr(get_option('rasa_main_email', 'info@rasasystemco.com')); ?>" class="cta-email glass-card hover-3d">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <span class="contact-label">ایمیل</span>
                            <span class="contact-value"><?php echo esc_html(get_option('rasa_main_email', 'info@rasasystemco.com')); ?></span>
                        </div>
                    </a>
                    <a href="https://rasa99.ir" target="_blank" class="cta-website glass-card hover-3d">
                        <i class="fas fa-globe"></i>
                        <div>
                            <span class="contact-label">وبسایت</span>
                            <span class="contact-value">rasa99.ir</span>
                        </div>
                    </a>
                </div>
                <div style="margin-top: 3rem;">
                    <a href="#contact" class="btn btn-primary btn-lg hover-3d" style="padding: 1.5rem 4rem;">
                        <i class="fas fa-calendar-alt"></i>
                        رزرو جلسه مشاوره رایگان
                    </a>
                </div>
            </div>
        </section>

        <!-- ========== BLOG SECTION ========== -->
        <?php 
        if (have_posts()):
            echo '<section class="section blog-section animate-on-scroll">';
            echo '<div class="section-header">';
            echo '<h2 class="section-title">آخرین <span class="highlight">مقالات</span></h2>';
            echo '<p class="section-subtitle">مطالب آموزشی و اخبار حوزه نرم‌افزارهای سازمانی</p>';
            echo '</div>';
            echo '<div class="blog-posts stagger-animate">';
            
            // تنظیمات پست‌ها
            $args = array(
                'posts_per_page' => 3,
                'post_type' => 'post',
                'post_status' => 'publish'
            );
            $blog_posts = new WP_Query($args);
            
            if ($blog_posts->have_posts()):
                while ($blog_posts->have_posts()): $blog_posts->the_post();
                    echo '<article class="blog-post glass-card hover-3d">';
                    
                    // تصویر شاخص
                    if (has_post_thumbnail()) {
                        echo '<div class="post-image">';
                        the_post_thumbnail('large', array('loading' => 'lazy'));
                        echo '<div class="post-category">مقالات</div>';
                        echo '</div>';
                    }
                    
                    echo '<div class="post-content">';
                    
                    // تاریخ
                    echo '<div class="post-meta">';
                    echo '<span><i class="far fa-calendar"></i> ' . get_the_date() . '</span>';
                    echo '<span><i class="far fa-eye"></i> ' . get_post_meta(get_the_ID(), 'post_views', true) . ' بازدید</span>';
                    echo '</div>';
                    
                    // عنوان
                    echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                    
                    // خلاصه
                    echo '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
                    
                    // دکمه ادامه مطلب
                    echo '<a href="' . get_permalink() . '" class="post-read-more">';
                    echo 'ادامه مطلب <i class="fas fa-arrow-left"></i>';
                    echo '</a>';
                    
                    echo '</div>';
                    echo '</article>';
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p style="text-align: center; grid-column: 1/-1; color: var(--text-gray);">مقاله‌ای برای نمایش وجود ندارد.</p>';
            endif;
            
            echo '</div>';
            
            // دکمه مشاهده همه مقالات
            echo '<div style="text-align: center; margin-top: 3rem;">';
            echo '<a href="' . get_permalink(get_option('page_for_posts')) . '" class="btn btn-outline hover-3d">';
            echo '<i class="fas fa-newspaper"></i> مشاهده همه مقالات';
            echo '</a>';
            echo '</div>';
            
            echo '</section>';
        endif;
        ?>

        <!-- ========== INSTAGRAM FEED ========== -->
        <section class="section instagram-section animate-on-scroll" style="display: none;">
            <div class="section-header">
                <h2 class="section-title">ما در <span class="highlight">اینستاگرام</span></h2>
                <p class="section-subtitle">جدیدترین فعالیت‌ها و پروژه‌های ما را دنبال کنید</p>
            </div>
            <!-- Instagram feed will be loaded via JavaScript -->
            <div id="instagram-feed" class="instagram-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;"></div>
        </section>
        <?php
    }
} else {
    // برای صفحات دیگر (صفحات داخلی، پست‌ها، آرشیوها)
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    
                    <div class="entry-meta">
                        <span class="posted-on">
                            <i class="far fa-calendar"></i>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            <i class="far fa-user"></i>
                            <?php the_author(); ?>
                        </span>
                        <span class="comments-link">
                            <i class="far fa-comment"></i>
                            <?php comments_number('بدون دیدگاه', '۱ دیدگاه', '% دیدگاه'); ?>
                        </span>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('صفحات:', 'rasa-system'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>
                
                <footer class="entry-footer">
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_list) {
                        printf('<span class="cat-links"><i class="far fa-folder"></i> ' . esc_html__('دسته‌بندی: %s', 'rasa-system') . '</span>', $categories_list);
                    }
                    
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        printf('<span class="tags-links"><i class="fas fa-tags"></i> ' . esc_html__('برچسب‌ها: %s', 'rasa-system') . '</span>', $tags_list);
                    }
                    ?>
                </footer>
            </article>
            
            <?php
            // پست‌های مرتبط
            $related_posts = get_posts([
                'category__in' => wp_get_post_categories(get_the_ID()),
                'numberposts' => 3,
                'post__not_in' => [get_the_ID()]
            ]);
            
            if ($related_posts) :
                ?>
                <section class="related-posts">
                    <h3>مقالات مرتبط</h3>
                    <div class="related-posts-grid">
                        <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                            <article class="related-post">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="related-post-thumbnail">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="related-post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </article>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </section>
                <?php
            endif;
            
            // نظرات
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile;
    else :
        ?>
        <section class="no-results">
            <h2>مطلبی یافت نشد</h2>
            <p>متأسفانه هیچ مطلبی با معیارهای جستجوی شما یافت نشد.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        </section>
        <?php
    endif;
}

get_footer();