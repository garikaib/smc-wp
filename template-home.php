<?php
/**
 * Template Name: SMC Home Page
 * A custom high-fidelity template for the Social Marketing Centre.
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

<div id="smc-home-wrapper">
    <!-- Hero Slider Placeholder (Static version for now) -->
    <!-- Hero Slider -->
    <section class="smc-hero-slider">
        <div class="smc-slide-container">
            <div class="smc-hero-content">
                <h1 class="smc-hero-title">Take that 1st Step. Start Growing.</h1>
                <p class="smc-hero-subtitle">World-Class Business Science for the African Context.</p>
                <div class="smc-hero-actions">
                    <a href="<?php echo home_url('/free-assessment/'); ?>" class="smc-btn smc-btn-primary">Take the Assessment</a>
                </div>
            </div>
            
            <div class="smc-hero-interactions" id="smc-react-slider-root">
                 <!-- React Component will mount here -->
            </div>
        </div>
    </section>

    <!-- SMC Services Section -->
    <section class="smc-services-section">
        <div class="smc-container">
            <h2 class="smc-section-title">Holistic Growth for African Businesses</h2>
            <p class="smc-section-desc">We combine data-driven assessments with human-led coaching to transform your organization.</p>
            
            <div class="smc-services-grid">
                <!-- Service 1 -->
                <div class="smc-service-card">
                    <div class="smc-service-icon">🚀</div>
                    <h3>Business Viability</h3>
                    <p>Know exactly where you stand. Our proprietary assessment tool evaluates your foundation, market fit, and financial health.</p>
                    <a href="#" class="smc-link-btn">Start Free Assessment <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Service 2 -->
                <div class="smc-service-card">
                    <div class="smc-service-icon">👥</div>
                    <h3>Strategic Training</h3>
                    <p>Empower your team with world-class sales, customer service, and leadership training tailored for the African context.</p>
                    <a href="#" class="smc-link-btn">Explore Training <i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Service 3 -->
                <div class="smc-service-card">
                    <div class="smc-service-icon">📈</div>
                    <h3>Operational Capacity</h3>
                    <p>Build systems that scale. We help you optimize operations to drive real, measurable business outcomes.</p>
                    <a href="#" class="smc-link-btn">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- SMC Resources Section -->
    <section class="smc-resources-section">
        <div class="smc-container">
            <h2 class="smc-section-title">Improve Your Viability & Scale Faster</h2>
            <p class="smc-section-desc">Access our library of free training materials, guides, and templates designed to help you scale your business immediately.</p>
            
            <div class="smc-resources-content">
                <div class="smc-resource-featured">
                    <div class="resource-tag">NEW GUIDE</div>
                    <h3>The MSME Viability Toolkit</h3>
                    <p>Get our expert-led resources on improving business viability, optimizing operations, and navigating the 5 stages of growth in the African context.</p>
                    <a href="<?php echo home_url('/articles/'); ?>" class="smc-btn smc-btn-primary">Read Free Resources</a>
                </div>
                <div class="smc-resource-image">
                    <img src="https://smc-wp.ddev.site/wp-content/uploads/2020/09/article-3-featured.jpg" alt="Growth Toolkit">
                </div>
            </div>
        </div>
    </section>

    <!-- SMC Testimonials Section -->
    <section class="smc-testimonials-section">
        <div class="smc-container">
            <h2 class="smc-section-title white-text">Trusted by African Leaders</h2>
            
            <div class="smc-testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="smc-testimonial-card">
                    <p class="testimonial-text">"SMC transformed our small retailer into a national brand. The viability assessment saved us months of guesswork and focused our strategy."</p>
                    <div class="testimonial-author">
                        <img src="https://placehold.co/60x60/A1232A/ffffff?text=SM" alt="Sarah M.">
                        <div>
                            <h4>Sarah M.</h4>
                            <span>CEO, GreenLeaf Retail</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="smc-testimonial-card">
                    <p class="testimonial-text">"The leadership training was a game-changer for our managers. We've seen a 40% increase in team productivity since partnering with SMC."</p>
                    <div class="testimonial-author">
                        <img src="https://placehold.co/60x60/0E7673/ffffff?text=DK" alt="David K.">
                        <div>
                            <h4>David K.</h4>
                            <span>Founder, TechInnovate Zim</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="smc-testimonial-card">
                    <p class="testimonial-text">"Finally, a consulting firm that understands the local context. SMC's approach is practical, data-driven, and incredibly effective."</p>
                    <div class="testimonial-author">
                        <img src="https://placehold.co/60x60/D48900/ffffff?text=TN" alt="Tariro N.">
                        <div>
                            <h4>Tariro N.</h4>
                            <span>Director, Sunrise Agribusiness</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Logo Ticker -->
    <div id="smc-react-ticker-root"></div>
</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
