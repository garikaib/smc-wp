<?php
/**
 * Template Name: SMC About Page
 * A custom high-fidelity template for the About Us page.
 *
 * @package smc
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header(); ?>

<!-- Break out of Avada's default container -->
</div></main>

<div id="smc-wrapper">

    <!-- Hero Section -->
    <section class="smc-page-hero">
        <div class="smc-page-hero-content">
            <h1 class="smc-hero-subtitle">Leading Through Innovation</h1>
            <h1>Our Vision & Mission</h1>
            <p class="smc-hero-desc">Social Marketing Centre (SMC) is dedicated to bringing world-class business science to the African context. We empower entrepreneurs and MSMEs with the toolkit required to scale sustainably.</p>
        </div>
    </section>

    <div class="smc-page-container">
        
        <!-- Info Section (Two Columns) -->
        <section class="smc-section">
            <div class="smc-card-grid-2">
                <div class="smc-about-text">
                    <h3 class="smc-heading-lg" style="color: var(--smc-teal);">Why We Exist</h3>
                    <p class="smc-text-body">We believe that the future of Africa's prosperity lies in the hands of its entrepreneurs. However, generic business advice often fails to account for the unique challenges of the African market. SMC bridges this gap by combining global best practices with local expertise.</p>
                    <p class="smc-text-body">Our methodologies are data-driven, tested, and designed for scalability. Whether you are a startup looking for your first 100 customers or an established MSME aiming for regional expansion, we have the science to help you succeed.</p>
                </div>
                <div class="smc-about-image">
                    <img src="<?php echo home_url('/wp-content/uploads/2020/09/article-3-featured.jpg'); ?>" alt="About SMC" class="smc-img-rounded">
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="smc-section" style="margin-top: 80px;">
            <div style="text-align: center; margin-bottom: 50px;">
                <h2 class="smc-heading-lg" style="color: var(--smc-red);">Our Core Values</h2>
                <p class="smc-text-body">The principles that guide every interaction we have.</p>
            </div>
            
            <div class="smc-card-grid-3">
                <!-- Value 1 -->
                <div class="smc-feature-card">
                    <div class="smc-icon-circle">
                         <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="smc-heading-md" style="font-size: 20px;">Innovation</h4>
                    <p class="smc-text-body" style="font-size: 14px; margin-bottom: 0;">Applying cutting-edge business science to solve complex challenges.</p>
                </div>

                <!-- Value 2 -->
                <div class="smc-feature-card">
                    <div class="smc-icon-circle red">
                         <i class="fas fa-users"></i>
                    </div>
                    <h4 class="smc-heading-md" style="font-size: 20px;">Community</h4>
                    <p class="smc-text-body" style="font-size: 14px; margin-bottom: 0;">Building a collaborative ecosystem for entrepreneurs to thrive together.</p>
                </div>

                <!-- Value 3 -->
                <div class="smc-feature-card">
                     <div class="smc-icon-circle">
                         <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="smc-heading-md" style="font-size: 20px;">Integrity</h4>
                    <p class="smc-text-body" style="font-size: 14px; margin-bottom: 0;">Ensuring transparency and ethical standards in every consultation.</p>
                </div>
            </div>
        </section>

    </div>

    <!-- CTA Bar -->
    <section class="smc-cta-bar">
        <div class="smc-page-container" style="margin-bottom: 0;">
            <h2>We're Waiting To Help You</h2>
            <p>Learn more about how our methodologies can help your business achieve long-term viability.</p>
            <a href="<?php echo home_url('/contact-us/'); ?>" class="smc-submit-btn" style="text-decoration: none; display: inline-block;">CONTACT US TODAY</a>
        </div>
    </section>

</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
