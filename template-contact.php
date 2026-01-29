<?php
/**
 * Template Name: SMC Contact Page
 * A custom high-fidelity template for the Contact Us page.
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

<div id="smc-contact-wrapper" class="smc-contact-wrapper">

    <!-- Hero Section -->
    <section class="smc-contact-hero">
        <div class="smc-container">
            <div class="smc-contact-intro" style="margin-top: 40px;">
                <h2 class="smc-contact-subtitle">Get In Touch Today</h2>
                <h2>We're Here To Help</h2>
                <p class="smc-contact-desc">Get in touch with the Social Marketing Centre. We are here to help you scale your business with world-class science tailored for the African context. Our team is ready to support your growth journey.</p>
            </div>
        </div>
    </section>

    <!-- Info Cards -->
    <section class="smc-contact-info">
        <div class="smc-contact-cards">
            <!-- Email Card -->
            <div class="smc-info-card email-card">
                <h3>Send Us An Email</h3>
                <p>Have a specific inquiry or need detailed information? Drop us an email and our specialists will get back to you within 24 hours.</p>
                <div class="smc-info-card-content">
                    <i class="far fa-envelope"></i> info@socialmarketingcentre.com
                </div>
            </div>

            <!-- Phone Card -->
            <div class="smc-info-card phone-card">
                <h3>Give Us A Call</h3>
                <p>Prefer a direct conversation? Give us a call during business hours for immediate assistance with your business scaling needs.</p>
                <div class="smc-info-card-content">
                    <i class="fas fa-phone-alt"></i> +263 77 123 4567
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="smc-contact-form-section">
        <h2 class="smc-contact-subtitle" style="color:#A1232A;">Send Us A Message</h2>
        <h2 style="font-size:36px;color:#0E7673;">Quick Contact</h2>
        
        <form action="#" method="post" class="smc-contact-form">
            <div class="smc-form-grid">
                <div class="smc-form-group">
                    <input type="text" class="smc-form-control" placeholder="Your Name" required>
                </div>
                <div class="smc-form-group">
                    <input type="email" class="smc-form-control" placeholder="Your Email" required>
                </div>
                <div class="smc-form-group full-width">
                    <input type="text" class="smc-form-control" placeholder="Your Telephone Number">
                </div>
                <div class="smc-form-group full-width">
                    <textarea class="smc-form-control" placeholder="Your Message" required></textarea>
                </div>
            </div>
            <button type="submit" class="smc-submit-btn">SUBMIT</button>
        </form>
    </section>
    
    <!-- Testimonials (Optional - keeping generic client section out for now or reusing generic style if needed, but user didn't explicitly ask for it here, just "appropriate stuff") -->
    
    <!-- "Waiting To Help You" Gradient Bar -->
    <section class="smc-waiting-bar">
        <div class="smc-waiting-content">
            <div class="smc-waiting-text">
                <h2>We're Waiting To Help You</h2>
                <p>Get in touch with us today and let's start transforming your business from the ground up.</p>
            </div>
            <div class="smc-waiting-action">
                <a href="#" class="smc-waiting-btn">BOOK A CONSULTATION</a>
            </div>
        </div>
    </section>

</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
