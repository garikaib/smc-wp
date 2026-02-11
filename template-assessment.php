<?php
/**
 * Template Name: SMC Assessment Page
 * A clean, full-width template for the assessment quiz.
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

<div id="smc-wrapper" class="smc-assessment-page">
    
    <!-- Hero Section -->
    <section class="smc-assessment-hero">
        <div class="hero-overlay"></div>
        <div class="smc-container">
            <div class="hero-content">
                <span class="hero-badge">Deep Analysis</span>
                <h1 class="hero-title">Business Viability Assessment</h1>
                <p class="hero-excerpt">Measure your foundation, identify critical gaps, and unlock the next stage of growth with our proprietary assessment tool.</p>
            </div>
        </div>
    </section>

    <!-- Page Content Area -->
    <div class="smc-assessment-wrapper">
        <div class="smc-assessment-container">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>

</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof gsap !== 'undefined') {
        // Hero Animation
        const heroContent = document.querySelector(".hero-content");
        if (heroContent) {
            gsap.from(heroContent, {
                duration: 1,
                y: 50,
                opacity: 0,
                ease: "power3.out",
                delay: 0.2
            });
        }

        // Form Container Animation
        const assessmentContainer = document.querySelector(".smc-assessment-container");
        if (assessmentContainer) {
            gsap.from(assessmentContainer, {
                duration: 1,
                y: 80,
                opacity: 0,
                ease: "power2.out",
                delay: 0.5
            });
        }

        // Interactive "Breathing" for Inputs
        const inputs = document.querySelectorAll('.ginput_container input, .ginput_container textarea');
        if (inputs.length > 0) {
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    gsap.to(input, { scale: 1.02, duration: 0.3, ease: "power1.out" });
                });
                input.addEventListener('blur', () => {
                    gsap.to(input, { scale: 1, duration: 0.3, ease: "power1.out" });
                });
            });
        }
    }
});
</script>
<?php get_footer(); ?>
