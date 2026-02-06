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

<div id="smc-wrapper" class="smc-contact-page">

    <!-- Hero Section -->
    <section class="smc-contact-hero">
        <div class="hero-bg-overlay"></div>
        <div class="smc-page-container">
            <div class="hero-content">
                <span class="hero-badge" data-aos="fade-down">Get In Touch</span>
                <h1 class="hero-title" data-aos="fade-up">We're Here To Help You Scale</h1>
                <p class="hero-desc" data-aos="fade-up" data-aos-delay="100">Connect with the Social Marketing Centre. Whether you have a specific inquiry or just want to explore how world-class business science can transform your enterprise, our team is ready.</p>
            </div>
        </div>
    </section>

    <div class="smc-page-container main-content">
        
        <!-- Info Cards Grid -->
        <div class="smc-contact-info-grid">
            <!-- Email Card -->
            <div class="smc-contact-card" data-card="email">
                <div class="card-icon">
                    <i data-lucide="mail"></i>
                </div>
                <h3 class="card-label">Send Us An Email</h3>
                <p class="card-text">Detailed inquiries or information requests.</p>
                <a href="mailto:info@socialmarketingcentre.com" class="card-value">info@socialmarketingcentre.com</a>
            </div>

            <!-- Phone Card -->
            <div class="smc-contact-card" data-card="phone">
                <div class="card-icon">
                    <i data-lucide="phone"></i>
                </div>
                <h3 class="card-label">Give Us A Call</h3>
                <p class="card-text">Immediate assistance during business hours.</p>
                <a href="tel:+263771234567" class="card-value">+263 77 123 4567</a>
            </div>

            <!-- Location Card -->
            <div class="smc-contact-card" data-card="location">
                <div class="card-icon">
                    <i data-lucide="map-pin"></i>
                </div>
                <h3 class="card-label">Visit Our Office</h3>
                <p class="card-text">Innovation Hub, Harare, Zimbabwe.</p>
                <span class="card-value">Harare Business District</span>
            </div>
        </div>

        <!-- Contact Form Section -->
        <section class="smc-contact-form-section">
            <div class="form-card">
                <div class="form-header">
                    <h2 class="form-title">Send Us A Message</h2>
                    <p class="form-subtitle">Fill out the form below and our specialists will reach out to you within 24 hours.</p>
                </div>
                
                <form action="#" method="post" class="smc-contact-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="user_name">Full Name</label>
                            <div class="input-wrapper">
                                <i data-lucide="user"></i>
                                <input type="text" id="user_name" class="form-control" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email Address</label>
                            <div class="input-wrapper">
                                <i data-lucide="mail"></i>
                                <input type="email" id="user_email" class="form-control" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label for="user_phone">Telephone (Optional)</label>
                            <div class="input-wrapper">
                                <i data-lucide="smartphone"></i>
                                <input type="text" id="user_phone" class="form-control" placeholder="+263 ...">
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label for="user_message">Your Message</label>
                            <textarea id="user_message" class="form-control" placeholder="How can we help your business thrive?" rows="5" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="smc-submit-btn">
                        <span>Send Message</span>
                        <i data-lucide="send"></i>
                    </button>
                </form>
            </div>
        </section>
        
    </div>

    <!-- CTA Bar -->
    <section class="smc-contact-cta">
        <div class="smc-page-container">
            <div class="cta-inner">
                <h2>Ready to transform your business?</h2>
                <div class="cta-actions">
                    <a href="mailto:consult@socialmarketingcentre.com" class="smc-cta-btn secondary">Book a Consultation</a>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // GSAP Animations
    if (typeof gsap !== 'undefined') {
        const tl = gsap.timeline({ defaults: { ease: "power3.out", duration: 1 }});

        tl.from(".hero-content > *", {
            y: 30,
            opacity: 0,
            stagger: 0.1,
            delay: 0.2
        })
        .from(".smc-contact-card", {
            y: 40,
            opacity: 0,
            stagger: 0.1
        }, "-=0.5")
        .from(".form-card", {
            scale: 0.98,
            opacity: 0,
            duration: 1.2
        }, "-=0.8");

        // Hover animations for cards
        const cards = document.querySelectorAll('.smc-contact-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card.querySelector('.card-icon'), {
                    scale: 1.1,
                    rotate: 5,
                    duration: 0.3
                });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(card.querySelector('.card-icon'), {
                    scale: 1,
                    rotate: 0,
                    duration: 0.3
                });
            });
        });
    }

    // Re-render Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>


<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
