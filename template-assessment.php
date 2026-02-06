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

<!-- Page Container for React App -->
<div class="smc-assessment-wrapper" style="width: 100%; padding: 0;">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof gsap !== 'undefined') {
        // Hero Animation
        gsap.from(".hero-content", {
            duration: 1,
            y: 50,
            opacity: 0,
            ease: "power3.out",
            delay: 0.2
        });

        // Form Container Animation
        gsap.from(".smc-assessment-container", {
            duration: 1,
            y: 80,
            opacity: 0,
            ease: "power2.out",
            delay: 0.5
        });

        // Interactive "Breathing" for Inputs
        const inputs = document.querySelectorAll('.ginput_container input, .ginput_container textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                gsap.to(input, { scale: 1.02, duration: 0.3, ease: "power1.out" });
            });
            input.addEventListener('blur', () => {
                gsap.to(input, { scale: 1, duration: 0.3, ease: "power1.out" });
            });
        });
    }
});
</script>
<?php get_footer(); ?>
