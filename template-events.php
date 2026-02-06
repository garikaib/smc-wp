<?php
/**
 * Template Name: SMC Events Calendar
 *
 * @package smc
 */

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
            <h1 class="smc-hero-subtitle">Connect & Grow</h1>
            <h1>Upcoming Events</h1>
            <p class="smc-hero-desc">Join us for workshops, seminars, and networking opportunities designed to help your business grow.</p>
        </div>
    </section>

    <div class="smc-page-container">
        <div id="smc-events-root">
            <!-- React Component will mount here -->
            <div style="text-align: center; padding: 40px; color: var(--smc-text-muted);">Loading events...</div>
        </div>
    </div>
</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
