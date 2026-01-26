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
                <h1 class="smc-hero-title">Transform people and organizations</h1>
                <p class="smc-hero-subtitle">Empower all of your people with scalable, measurable digital coaching and drive real business outcomes.</p>
                <div class="smc-hero-actions">
                    <a href="#" class="smc-btn smc-btn-primary">GET STARTED</a>
                </div>
            </div>
            
            <div class="smc-hero-interactions" id="smc-react-slider-root">
                 <!-- React Component will mount here -->
            </div>
        </div>
    </section>
</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
