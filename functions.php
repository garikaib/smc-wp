<?php
/**
 * SMC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package smc
 */

// Include Hero Slides CPT
require_once get_stylesheet_directory() . '/inc/hero-slides.php';

function smc_enqueue_styles() {
    // Enqueue the parent theme style
    wp_enqueue_style( 'avada-parent-style', get_template_directory_uri() . '/style.css' );

    // Enqueue the child theme style
    wp_enqueue_style( 'smc-child-style', get_stylesheet_uri(), array( 'avada-parent-style' ), wp_get_theme()->get('Version') );

    // Enqueue Google Fonts (Outfit and Montserrat)
    wp_enqueue_style( 'smc-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap', array(), null );

    // Enqueue Homepage Specific Styles & Scripts
    if ( is_page_template( 'template-home.php' ) ) {
        wp_enqueue_style( 'smc-home-style', get_stylesheet_directory_uri() . '/css/home.css', array( 'smc-child-style' ), wp_get_theme()->get('Version') );
        
        // Enqueue the built React file
        wp_enqueue_script( 'smc-hero-react', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.js', array(), wp_get_theme()->get('Version'), true );
        
        // Enqueue the built CSS
        wp_enqueue_style( 'smc-hero-react-css', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.css', array(), wp_get_theme()->get('Version') );

        // Fetch Dynamic Data for React
        $slider_data = array();
        $slides = new WP_Query( array(
            'post_type'      => 'hero_slide',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ) );

        if ( $slides->have_posts() ) {
            while ( $slides->have_posts() ) {
                $slides->the_post();
                $slider_data[] = array(
                    'id'    => get_the_ID(),
                    'text'  => get_the_title(),
                    'icon'  => get_post_meta( get_the_ID(), '_smc_slide_icon', true ),
                    'image' => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
                );
            }
            wp_reset_postdata();
        }

        // Pass data to script
        wp_add_inline_script( 'smc-hero-react', 'const smcHeroData = ' . json_encode( $slider_data ) . ';', 'before' );
    }
}
add_action( 'wp_enqueue_scripts', 'smc_enqueue_styles' );

// Add type="module" to the React script
function smc_add_module_type( $tag, $handle, $src ) {
    if ( 'smc-hero-react' === $handle ) {
        return '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'smc_add_module_type', 10, 3 );

function smc_register_menus() {
    register_nav_menus(
        array(
            'top_menu'     => __( 'Top Menu', 'smc' ),
            'footer_col_1' => __( 'About Us', 'smc' ),
            'footer_col_2' => __( 'Assessment Tools', 'smc' ),
            'footer_col_3' => __( 'Training & Proficiency', 'smc' ),
        )
    );
}
add_action( 'init', 'smc_register_menus' );

/**
 * Shortcode to render the custom SMC Header
 */
function smc_custom_header_shortcode() {
    ob_start();
    ?>
    <div class="smc-header-container">
        <div class="smc-top-bar">
            <div class="fusion-row">
                <span>AIMY™: the AI Coach, just got smarter. <a href="#">Learn more</a></span>
            </div>
        </div>
        <header class="smc-main-nav">
                <div class="smc-logo-container">
                    <a href="<?php echo home_url(); ?>">
                        <img src="https://smc-wp.ddev.site/wp-content/uploads/2026/01/smc_logo_cropped-1.png" alt="SMC Logo">
                    </a>
                </div>
                
                <nav class="smc-nav-links">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'top_menu',
                        'container'      => false,
                        'menu_class'     => '',
                        'fallback_cb'    => false,
                        'depth'          => 2,
                    ) );
                    ?>
                </nav>

                <div class="smc-actions">
                    <a href="<?php echo wp_login_url(); ?>" class="smc-login-link">
                        <i class="fas fa-arrow-right"></i> LOG IN
                    </a>
                    <a href="#" class="smc-cta-btn">REQUEST A DEMO</a>
                </div>
        </header>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'smc_custom_header', 'smc_custom_header_shortcode' );
/**
 * Add Social Media settings to the WordPress Customizer
 */
function smc_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'smc_social_links', array(
        'title'    => __( 'SMC Social Links', 'smc' ),
        'priority' => 30,
    ) );

    $networks = array(
        'linkedin'  => 'LinkedIn',
        'twitter'   => 'Twitter / X',
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'tiktok'    => 'TikTok',
    );

    foreach ( $networks as $key => $label ) {
        $wp_customize->add_setting( "smc_social_$key", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );

        $wp_customize->add_control( "smc_social_$key", array(
            'label'    => $label,
            'section'  => 'smc_social_links',
            'type'     => 'text',
        ) );
    }
}
add_action( 'customize_register', 'smc_customize_register' );
