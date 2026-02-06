<?php
/**
 * The template for displaying all single posts.
 * Boutique high-fidelity template for Social Marketing Centre.
 *
 * @package smc
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();

// Get post data
$post_id          = get_the_ID();
$featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
$post_title       = get_the_title();
$post_date        = get_the_date('F j, Y');
$post_author      = get_the_author();
$categories       = get_the_category();

// Fallback image if featured is missing
if (!$featured_img_url) {
    $featured_img_url = get_stylesheet_directory_uri() . '/assets/img/default-article-bg.jpg';
}
?>

<style>
/* Boutique Internal Overrides to ensure the Page Title Bar is GONE */
.fusion-page-title-bar, 
#main > .fusion-row:first-child > .fusion-breadcrumbs {
    display: none !important;
}

/* Ensure main content starts fresh */
#main {
    padding: 0 !important;
}

.fusion-row {
    max-width: 100% !important;
}
</style>

<!-- Break out of Avada's default container -->
</div></main>

<article id="post-<?php the_ID(); ?>" <?php post_class('smc-boutique-article'); ?>>
    
    <!-- Cinematic Hero Section -->
    <header class="smc-article-hero-cinematic">
        <div class="hero-bg-overlay" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');"></div>
        <div class="hero-gradient-mask"></div>
        
        <div class="smc-page-container">
            <div class="hero-content-inner" data-gsap-reveal="up">
                <nav class="smc-boutique-breadcrumbs">
                    <a href="<?php echo home_url(); ?>">Home</a> 
                    <i data-lucide="chevron-right" class="breadcrumb-sep"></i>
                    <a href="<?php echo home_url('/articles/'); ?>">Articles</a> 
                    <i data-lucide="chevron-right" class="breadcrumb-sep"></i>
                    <span class="current"><?php echo esc_html($post_title); ?></span>
                </nav>
                
                <h1 class="smc-article-main-title"><?php echo esc_html($post_title); ?></h1>
                
                <div class="smc-article-meta-signature">
                    <div class="author-info">
                        <div class="author-avatar-proxy">
                            <i data-lucide="user"></i>
                        </div>
                        <div class="author-details">
                            <span class="written-by">Written by</span>
                            <span class="author-name"><?php echo esc_html($post_author); ?></span>
                        </div>
                    </div>
                    <div class="meta-separator"></div>
                    <div class="publish-date">
                        <i data-lucide="calendar"></i>
                        <span><?php echo esc_html($post_date); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Area with Modern Layout -->
    <div class="smc-article-main-body">
        <div class="smc-page-container">
            <div class="smc-article-layout-grid">
                
                <!-- Sidebar Nav/Share (Sticky) -->
                <aside class="smc-article-sticky-sidebar left">
                    <div class="sticky-inner" data-gsap-reveal="fade">
                        <div class="share-label">Share</div>
                        <div class="share-icons">
                            <a href="#" class="share-link"><i data-lucide="linkedin"></i></a>
                            <a href="#" class="share-link"><i data-lucide="twitter"></i></a>
                            <a href="#" class="share-link"><i data-lucide="link"></i></a>
                        </div>
                    </div>
                </aside>

                <!-- Primary Content -->
                <main class="smc-article-primary-content">
                    <div class="smc-entry-content-boutique" data-gsap-reveal="fade">
                        <?php 
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile; 
                        ?>
                    </div>
                    
                    <!-- Post Footer Tags -->
                    <?php if (has_tag()): ?>
                        <div class="smc-post-tags">
                            <?php the_tags('', ' ', ''); ?>
                        </div>
                    <?php endif; ?>
                </main>

                <!-- Right Sidebar CTA -->
                <aside class="smc-article-sticky-sidebar right">
                    <div class="cta-card-premium" data-gsap-reveal="right">
                        <div class="cta-icon-wrapper">
                            <i data-lucide="sparkles"></i>
                        </div>
                        <h3>Deep Business Science</h3>
                        <p>Join the elite African business leaders who use SMC data to scale their operations.</p>
                        <a href="<?php echo home_url('/assessment/'); ?>" class="smc-btn smc-btn-teal-outline">View Assessments</a>
                    </div>
                </aside>

            </div>
        </div>
    </div>

</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Premium GSAP Reveal Sequence
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        const tl = gsap.timeline();

        // Hero Reveal
        tl.from(".smc-article-hero-cinematic .hero-bg-overlay", {
            scale: 1.1,
            opacity: 0,
            duration: 1.5,
            ease: "power2.out"
        }).from(".hero-content-inner", {
            y: 30,
            opacity: 0,
            duration: 1,
            ease: "expo.out"
        }, "-=1");

        // Content Staggered Entry
        gsap.from(".smc-entry-content-boutique > *", {
            y: 20,
            opacity: 0,
            stagger: 0.1,
            duration: 0.8,
            ease: "power2.out",
            scrollTrigger: {
                trigger: ".smc-entry-content-boutique",
                start: "top 80%"
            }
        });

        // Sticky Sidebar Entrance
        gsap.from(".left .sticky-inner", {
            x: -20,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            delay: 0.5
        });

        gsap.from(".right .cta-card-premium", {
            x: 20,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            delay: 0.8
        });
    }

    // Refresh icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
