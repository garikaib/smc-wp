<?php
/**
 * Template Name: SMC Quiz Builder
 * A full-width, clean template for the Assessment Center (Quiz Builder).
 *
 * @package smc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<!-- Simple full-width container for React App -->
<div id="smc-quiz-builder-page-wrapper" class="smc-quiz-builder-full-width">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<style>
/* Ensure the wrapper doesn't have theme constraints that break the builder UI */
#smc-quiz-builder-page-wrapper {
    width: 100%;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background: #fdfdfd; /* Default light bg, React app will override */
}

/* Specific resets for Avada/Theme containers if they leak in */
.fusion-row { max-width: none !important; }
#main { padding: 0 !important; }
</style>

<?php get_footer(); ?>
