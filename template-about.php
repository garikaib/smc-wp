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

<div id="smc-about-wrapper" class="smc-contact-wrapper">

    <!-- Hero Section -->
    <section class="smc-contact-hero">
        <div class="smc-container">
            <div class="smc-contact-intro" style="margin-top: 40px;">
                <h2 class="smc-contact-subtitle">Leading Through Innovation</h2>
                <h2>Our Vision & Mission</h2>
                <p class="smc-contact-desc">Social Marketing Centre (SMC) is dedicated to bringing world-class business science to the African context. We empower entrepreneurs and MSMEs with the toolkit required to scale sustainably and thrive in a competitive landscape.</p>
            </div>
        </div>
    </section>

    <!-- Info Section (Two Columns) -->
    <section class="smc-about-details" style="padding: 0 40px 100px; max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div class="smc-about-text">
                <h3 style="font-family: 'Outfit', sans-serif; color: #0E7673; font-size: 32px; margin-bottom: 20px;">Why We Exist</h3>
                <p style="font-size: 16px; line-height: 1.8; color: #4A4A68;">We believe that the future of Africa's prosperity lies in the hands of its entrepreneurs. However, generic business advice often fails to account for the unique challenges of the African market. SMC bridges this gap by combining global best practices with local expertise.</p>
                <p style="font-size: 16px; line-height: 1.8; color: #4A4A68; margin-top: 20px;">Our methodologies are data-driven, tested, and designed for scalability. Whether you are a startup looking for your first 100 customers or an established MSME aiming for regional expansion, we have the science to help you succeed.</p>
            </div>
            <div class="smc-about-image">
                <img src="https://smc-wp.ddev.site/wp-content/uploads/2020/09/article-3-featured.jpg" alt="About SMC" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </section>

    <!-- Values Section (Cards) -->
    <section class="smc-values" style="background: #F8F9FF; padding: 100px 40px;">
        <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <h2 style="font-family: 'Outfit', sans-serif; color: #A1232A; font-size: 36px; margin-bottom: 60px;">Our Core Values</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: rgba(14, 118, 115, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-lightbulb" style="color: #0E7673; font-size: 24px;"></i>
                    </div>
                    <h4 style="font-family: 'Outfit', sans-serif; color: #1A1A3D; font-size: 20px; margin-bottom: 15px;">Innovation</h4>
                    <p style="font-size: 14px; color: #4A4A68; line-height: 1.6;">Applying cutting-edge business science to solve complex challenges.</p>
                </div>
                <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: rgba(161, 35, 42, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-users" style="color: #A1232A; font-size: 24px;"></i>
                    </div>
                    <h4 style="font-family: 'Outfit', sans-serif; color: #1A1A3D; font-size: 20px; margin-bottom: 15px;">Community</h4>
                    <p style="font-size: 14px; color: #4A4A68; line-height: 1.6;">Building a collaborative ecosystem for entrepreneurs to thrive together.</p>
                </div>
                <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.02); transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; background: rgba(14, 118, 115, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px;">
                        <i class="fas fa-chart-line" style="color: #0E7673; font-size: 24px;"></i>
                    </div>
                    <h4 style="font-family: 'Outfit', sans-serif; color: #1A1A3D; font-size: 20px; margin-bottom: 15px;">Integrity</h4>
                    <p style="font-size: 14px; color: #4A4A68; line-height: 1.6;">Ensuring transparency and ethical standards in every consultation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- "Waiting To Help You" Gradient Bar -->
    <section class="smc-waiting-bar">
        <div class="smc-waiting-content">
            <div class="smc-waiting-text">
                <h2>We're Waiting To Help You</h2>
                <p>Learn more about how our methodologies can help your business achieve long-term viability.</p>
            </div>
            <div class="smc-waiting-action">
                <a href="<?php echo home_url('/contact-us/'); ?>" class="smc-waiting-btn">CONTACT US TODAY</a>
            </div>
        </div>
    </section>

</div>

<!-- Re-open tags for footer.php to close properly -->
<main id="main">
<div class="fusion-row">
<?php get_footer(); ?>
