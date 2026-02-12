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
<?php get_footer(); ?>
