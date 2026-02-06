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
// Include Client Logos CPT
require_once get_stylesheet_directory() . '/inc/client-logos.php';
// Include Events CPT
require_once get_stylesheet_directory() . '/inc/events-cpt.php';

// Turnstile Configuration
define( 'SMC_TURNSTILE_SITEKEY', '0x4AAAAAACX9kdvX5puRi7sX' );
define( 'SMC_TURNSTILE_SECRET', '0x4AAAAAACX9kc7DQuwcKuolqIDIKy2dxLE' );

function smc_enqueue_styles() {
    // Enqueue the parent theme style
    wp_enqueue_style( 'avada-parent-style', get_template_directory_uri() . '/style.css' );

    // Enqueue the child theme style
    wp_enqueue_style( 'smc-child-style', get_stylesheet_uri(), array( 'avada-parent-style' ), wp_get_theme()->get('Version') );

    // Enqueue Google Fonts (Outfit and Montserrat)
    wp_enqueue_style( 'smc-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap', array(), null );

    // Enqueue Page Specific Styles
    if ( is_page_template( 'template-contact.php' ) || is_page_template( 'template-about.php' ) ) {
        wp_enqueue_style( 'smc-page-style', get_stylesheet_directory_uri() . '/css/contact.css', array( 'smc-child-style' ), wp_get_theme()->get('Version') );
    }

    if ( is_page_template( 'template-assessment.php' ) ) {
        wp_enqueue_style( 'smc-assessment-style', get_stylesheet_directory_uri() . '/css/assessment.css', array( 'smc-child-style' ), wp_get_theme()->get('Version') );
        wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), null, true );
    }

    // Enqueue Homepage Specific Styles & Scripts
    if ( is_page_template( 'template-home.php' ) ) {
        wp_enqueue_style( 'smc-home-style', get_stylesheet_directory_uri() . '/css/home.css', array( 'smc-child-style' ), wp_get_theme()->get('Version') );
        
        // Enqueue the built React file
        wp_enqueue_script( 'smc-hero-react', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.js', array(), wp_get_theme()->get('Version'), true );
        
        // Enqueue the built CSS
        wp_enqueue_style( 'smc-hero-react-css', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.css', array(), wp_get_theme()->get('Version') );

        // Fetch Dynamic Data for React Hero Slider
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

        // Fetch Client Logos
        $logo_data = array();
        $logos = new WP_Query( array(
            'post_type'      => 'client_logo',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ) );
        
        if ( $logos->have_posts() ) {
            while ( $logos->have_posts() ) {
                $logos->the_post();
                $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                if ( $img_url ) {
                    $logo_data[] = array(
                        'id'    => get_the_ID(),
                        'title' => get_the_title(),
                        'image' => $img_url,
                    );
                }
            }
            wp_reset_postdata();
        }

        // Pass data to script
        // Pass data to script
        $inline_script = 'window.smcHeroData = ' . json_encode( $slider_data ) . ';';
        $inline_script .= ' window.smcClientLogos = ' . json_encode( $logo_data ) . ';';
        
        wp_add_inline_script( 'smc-hero-react', $inline_script, 'before' );
    }

    // Enqueue Events Page Scripts
    if ( is_page_template( 'template-events.php' ) ) {
        // We reuse the same bundle because it contains the Events component
        wp_enqueue_script( 'smc-hero-react', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.js', array(), wp_get_theme()->get('Version'), true );
        wp_enqueue_style( 'smc-hero-react-css', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.css', array(), wp_get_theme()->get('Version') );

        // Fetch Events Data
        $events_data = array();
        $events_query = new WP_Query( array(
            'post_type'      => 'smc_event',
            'posts_per_page' => -1,
            'meta_key'       => '_smc_event_start_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ) );

        if ( $events_query->have_posts() ) {
            while ( $events_query->have_posts() ) {
                $events_query->the_post();
                $start = get_post_meta( get_the_ID(), '_smc_event_start_date', true );
                $end = get_post_meta( get_the_ID(), '_smc_event_end_date', true );
                $location = get_post_meta( get_the_ID(), '_smc_event_location', true );
                
                $events_data[] = array(
                    'id'          => get_the_ID(),
                    'title'       => get_the_title(),
                    'description' => get_the_content(), // Might need stripping tags if used in small cards
                    'excerpt'     => get_the_excerpt(),
                    'start'       => $start,
                    'end'         => $end,
                    'location'    => $location,
                    'image'       => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
                    'link'        => get_permalink()
                );
            }
            wp_reset_postdata();
        }

        $events_script = 'window.smcEventsData = ' . json_encode( $events_data ) . ';';
        wp_add_inline_script( 'smc-hero-react', $events_script, 'before' );
    }

    // Enqueue Events Calendar Custom Styles
    if ( class_exists( 'Tribe__Events__Main' ) ) {
        if ( tribe_is_event() || tribe_is_event_query() || is_post_type_archive( 'tribe_events' ) || is_singular( 'tribe_events' ) ) {
             wp_enqueue_style( 'smc-events-style', get_stylesheet_directory_uri() . '/css/events.css', array( 'smc-child-style' ), wp_get_theme()->get('Version') );
        }
    }

    // Enqueue React App on My Account page
    if ( is_page_template( 'template-my-account.php' ) ) {
        wp_enqueue_script( 'smc-hero-react', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.js', array(), wp_get_theme()->get('Version'), true );
        wp_enqueue_style( 'smc-hero-react-css', get_stylesheet_directory_uri() . '/assets/compiled/hero-slider.css', array(), wp_get_theme()->get('Version') );

        // Pass REST API nonce for Profile SPA
        wp_localize_script( 'smc-hero-react', 'wpApiSettings', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' )
        ) );
    }

    // Enqueue Theme Toggle Script
    wp_enqueue_script( 'smc-theme-toggle', get_stylesheet_directory_uri() . '/js/theme-toggle.js', array(), wp_get_theme()->get('Version'), true );

    // Enqueue Lucide Icons
    wp_enqueue_script( 'lucide-icons', 'https://unpkg.com/lucide@latest', array(), null, true );
    wp_add_inline_script( 'lucide-icons', 'document.addEventListener("DOMContentLoaded", () => { lucide.createIcons(); });' );
}
add_action( 'wp_enqueue_scripts', 'smc_enqueue_styles' );

// Add type="module" to the React script
function smc_add_module_type( $tag, $handle, $src ) {
    if ( 'smc-hero-react' === $handle ) {
        // Use str_replace to preserve other attributes
        return str_replace( '<script ', '<script type="module" ', $tag );
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
                <span>World-Class Business Science for the African Context. <a href="<?php echo home_url('/free-assessment/'); ?>">Take the assessment</a></span>
            </div>
        </div>
        <header class="smc-main-nav">
                <div class="smc-logo-container">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo home_url('/wp-content/uploads/2026/01/smc_logo_cropped-1.png'); ?>" alt="SMC Logo">
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
                    <a href="<?php echo home_url('/shop/'); ?>" class="smc-shop-link" style="margin-right: 20px;">
                        <i data-lucide="shopping-bag"></i> <?php echo __( 'Shop', 'smc' ); ?>
                    </a>

                    <?php if ( is_user_logged_in() ) : 
                        $current_user = wp_get_current_user();
                    ?>
                        <a href="<?php echo home_url('/my-account/'); ?>" class="smc-login-link logged-in">
                            <i data-lucide="user"></i> <?php echo esc_html( $current_user->display_name ); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo home_url('/my-account/'); ?>" class="smc-login-link">
                            <i class="fas fa-arrow-right"></i> LOG IN
                        </a>
                    <?php endif; ?>
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

/**
 * Handle Magic Login Request (AJAX)
 */
function smc_handle_magic_login() {
    check_ajax_referer( 'smc_auth_nonce', 'nonce' );

    $email = sanitize_email( $_POST['email'] );
    $turnstile_response = $_POST['cf-turnstile-response'];

    // Verify Turnstile
    $verify_url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $response = wp_remote_post( $verify_url, array(
        'body' => array(
            'secret'   => SMC_TURNSTILE_SECRET,
            'response' => $turnstile_response,
        ),
    ) );

    $response_body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! $response_body['success'] ) {
        wp_send_json_error( array( 'message' => 'Security verification failed. Please try again.' ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
    }

    $user = get_user_by( 'email', $email );
    if ( ! $user ) {
        wp_send_json_error( array( 'message' => 'User not found. Please register first.' ) );
    }

    // Generate Token
    $token = wp_generate_password( 32, false );
    update_user_meta( $user->ID, '_smc_magic_login_token', $token );
    update_user_meta( $user->ID, '_smc_magic_login_expiry', time() + ( 15 * MINUTE_IN_SECONDS ) );

    $login_url = add_query_arg( array(
        'smc_magic_token' => $token,
        'smc_user_id'     => $user->ID,
    ), home_url( '/my-account/' ) );

    $to      = $email;
    $subject = 'Your Magic Login Link for SMC';
    $message = "Click the link below to log in to your account:\n\n" . $login_url . "\n\nThis link will expire in 15 minutes.";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Use a more styled message if possible
    $styled_message = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px;'>
        <h2 style='color: #0E7673;'>Welcome to SMC</h2>
        <p>You requested a magic login link. Click the button below to sign in instantly:</p>
        <a href='{$login_url}' style='display: inline-block; padding: 12px 24px; background-color: #A1232A; color: #fff; text-decoration: none; border-radius: 30px; font-weight: bold;'>Login Now</a>
        <p style='font-size: 12px; color: #666; margin-top: 20px;'>If you didn't request this, you can safely ignore this email.</p>
    </div>";

    wp_mail( $to, $subject, $styled_message, $headers );

    wp_send_json_success( array( 'message' => 'Check your email for the magic link!' ) );
}
add_action( 'wp_ajax_smc_magic_login', 'smc_handle_magic_login' );
add_action( 'wp_ajax_nopriv_smc_magic_login', 'smc_handle_magic_login' );

/**
 * Handle Registration (AJAX)
 */
function smc_handle_registration() {
    check_ajax_referer( 'smc_auth_nonce', 'nonce' );

    $username = sanitize_user( $_POST['username'] );
    $email    = sanitize_email( $_POST['email'] );
    $password = $_POST['password'];
    $turnstile_response = $_POST['turnstile_response'];

    // Verify Turnstile
    $verify_url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $response = wp_remote_post( $verify_url, array(
        'body' => array(
            'secret'   => SMC_TURNSTILE_SECRET,
            'response' => $turnstile_response,
        ),
    ) );

    $response_body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! $response_body['success'] ) {
        wp_send_json_error( array( 'message' => 'Security verification failed. Please try again.' ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid email.' ) );
    }

    if ( empty( $username ) || empty( $password ) ) {
        wp_send_json_error( array( 'message' => 'All fields are required.' ) );
    }

    if ( username_exists( $username ) || email_exists( $email ) ) {
        wp_send_json_error( array( 'message' => 'User already exists.' ) );
    }

    $user_id = wp_create_user( $username, $password, $email );

    if ( is_wp_error( $user_id ) ) {
        wp_send_json_error( array( 'message' => $user_id->get_error_message() ) );
    }

    // Auto log in? Or ask them to check email?
    wp_set_auth_cookie( $user_id );
    wp_send_json_success( array( 'message' => 'Account created! Redirecting...', 'redirect' => home_url( '/my-account/' ) ) );
}
add_action( 'wp_ajax_smc_register', 'smc_handle_registration' );
add_action( 'wp_ajax_nopriv_smc_register', 'smc_handle_registration' );

/**
 * Handle Password-based Login (AJAX)
 */
function smc_handle_password_login() {
    check_ajax_referer( 'smc_auth_nonce', 'nonce' );

    $login    = sanitize_text_field( $_POST['log'] );
    $password = $_POST['pwd'];
    $turnstile_response = $_POST['cf-turnstile-response'];

    // Verify Turnstile
    $verify_url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $response = wp_remote_post( $verify_url, array(
        'body' => array(
            'secret'   => SMC_TURNSTILE_SECRET,
            'response' => $turnstile_response,
        ),
    ) );

    $response_body = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! $response_body[ 'success' ] ) {
        wp_send_json_error( array( 'message' => 'Security verification failed.' ) );
    }

    if ( empty( $login ) || empty( $password ) ) {
        wp_send_json_error( array( 'message' => 'All fields are required.' ) );
    }

    $user = ( is_email( $login ) ) ? get_user_by( 'email', $login ) : get_user_by( 'login', $login );

    if ( ! $user ) {
        wp_send_json_error( array( 'message' => 'User not found. Please register first.' ) );
    }

    $credentials = array(
        'user_login'    => $user->user_login,
        'user_password' => $password,
        'remember'      => true
    );

    $user_signon = wp_signon( $credentials, false );

    if ( is_wp_error( $user_signon ) ) {
        wp_send_json_error( array( 'message' => 'Invalid password. Please try again.' ) );
    }

    wp_send_json_success( array( 
        'message'  => 'Logged in successfully! Redirecting...', 
        'redirect' => home_url( '/my-account/' ) 
    ) );
}
add_action( 'wp_ajax_smc_password_login', 'smc_handle_password_login' );
add_action( 'wp_ajax_nopriv_smc_password_login', 'smc_handle_password_login' );

/**
 * Handle Magic Token Authentication
 */
function smc_process_magic_token() {
    if ( isset( $_GET['smc_magic_token'] ) && isset( $_GET['smc_user_id'] ) ) {
        $token   = sanitize_text_field( $_GET['smc_magic_token'] );
        $user_id = (int) $_GET['smc_user_id'];

        $saved_token  = get_user_meta( $user_id, '_smc_magic_login_token', true );
        $token_expiry = get_user_meta( $user_id, '_smc_magic_login_expiry', true );

        if ( $token === $saved_token && $token_expiry > time() ) {
            // Valid token
            delete_user_meta( $user_id, '_smc_magic_login_token' );
            delete_user_meta( $user_id, '_smc_magic_login_expiry' );
            wp_set_auth_cookie( $user_id );
            wp_redirect( home_url( '/my-account/' ) );
            exit;
        } else {
            // Invalid or expired
            wp_die( 'Invalid or expired magic link. Please request a new one.', 'Authentication Error', array( 'response' => 403 ) );
        }
    }
}
add_action( 'init', 'smc_process_magic_token' );

/**
 * SMC REST API: Profile Endpoints
 */
add_action( 'rest_api_init', function () {
    register_rest_route( 'smc/v1', '/profile', array(
        'methods' => 'GET',
        'callback' => 'smc_get_profile_data',
        'permission_callback' => function () {
            return is_user_logged_in();
        }
    ) );

    register_rest_route( 'smc/v1', '/profile', array(
        'methods' => 'POST',
        'callback' => 'smc_update_profile_data',
        'permission_callback' => function () {
            return is_user_logged_in();
        }
    ) );

    register_rest_route( 'smc/v1', '/profile/password', array(
        'methods' => 'POST',
        'callback' => 'smc_update_password',
        'permission_callback' => function () {
            return is_user_logged_in();
        }
    ) );
} );

function smc_get_profile_data() {
    $user = wp_get_current_user();
    return new WP_REST_Response( array(
        'first_name'   => $user->first_name,
        'last_name'    => $user->last_name,
        'display_name' => $user->display_name,
        'email'        => $user->user_email,
    ), 200 );
}

function smc_update_profile_data( $request ) {
    $params = $request->get_json_params();
    $user_id = get_current_user_id();

    $updates = array( 'ID' => $user_id );

    // Persistence fix: Ensure we update both users table and usermeta
    if ( isset( $params['first_name'] ) ) {
        $first_name = sanitize_text_field( $params['first_name'] );
        $updates['first_name'] = $first_name;
        update_user_meta( $user_id, 'first_name', $first_name );
    }
    if ( isset( $params['last_name'] ) ) {
        $last_name = sanitize_text_field( $params['last_name'] );
        $updates['last_name'] = $last_name;
        update_user_meta( $user_id, 'last_name', $last_name );
    }
    if ( ! empty( $params['display_name'] ) ) {
        $updates['display_name'] = sanitize_text_field( $params['display_name'] );
    }
    if ( ! empty( $params['email'] ) ) {
        $email = sanitize_email( $params['email'] );
        if ( is_email( $email ) ) {
            $updates['user_email'] = $email;
        } else {
            return new WP_Error( 'invalid_email', 'Invalid email address.', array( 'status' => 400 ) );
        }
    }

    $result = wp_update_user( $updates );

    if ( is_wp_error( $result ) ) {
        return $result;
    }

    return new WP_REST_Response( array( 'message' => 'Profile updated successfully!' ), 200 );
}

function smc_update_password( $request ) {
    $params = $request->get_json_params();
    $user_id = get_current_user_id();
    $user = get_userdata( $user_id );

    $current_pass = $params['current_password'];
    $new_pass = $params['new_password'];

    if ( ! wp_check_password( $current_pass, $user->user_pass, $user->ID ) ) {
        return new WP_Error( 'incorrect_password', 'Current password is incorrect.', array( 'status' => 403 ) );
    }

    if ( strlen( $new_pass ) < 8 ) {
        return new WP_Error( 'weak_password', 'Password must be at least 8 characters long.', array( 'status' => 400 ) );
    }

    wp_set_password( $new_pass, $user_id );

    return new WP_REST_Response( array( 'message' => 'Password updated successfully!' ), 200 );
}
