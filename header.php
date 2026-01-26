<?php
/**
 * Header template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<!DOCTYPE html>
<html class="<?php avada_the_html_class(); ?>" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php Avada()->head->the_viewport(); ?>

	<?php wp_head(); ?>

	<?php
	/**
	 * The setting below is not sanitized.
	 * In order to be able to take advantage of this,
	 * a user would have to gain access to the database
	 * in which case this is the least of your worries.
	 */
	echo apply_filters( 'avada_space_head', Avada()->settings->get( 'space_head' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	?>
    
    <!-- Custom SMC Header Styles -->
    <!-- Custom SMC Header Styles -->
    <style>
        :root {
            --smc-purple: #322B6B;
            --smc-purple-dark: #251f52;
            --smc-orange: #FF6D43;
            --smc-text-dark: #1A1A3D;
            --smc-gray-light: #F4F6FC;
            --smc-font-heading: 'Outfit', sans-serif;
            --smc-font-body: 'Montserrat', sans-serif;
        }

        .smc-top-bar {
            background-color: #4C1D4F;
            color: #ffffff;
            text-align: center;
            padding: 8px 0;
            font-family: var(--smc-font-body);
            font-size: 13px;
            z-index: 1001;
            position: relative;
        }
        .smc-top-bar a {
            color: #ffffff;
            text-decoration: underline;
            margin-left: 10px;
            font-weight: 600;
        }

        .smc-header-container {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
        }

        .smc-main-nav {
            background-color: #ffffff;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            max-width: 1400px;
            margin: 0 auto;
        }

        .smc-logo-container img {
            max-height: 45px;
            display: block;
        }

        /* Navigation Links & Underline Effect */
        .smc-nav-links {
            height: 100%;
        }
        .smc-nav-links ul {
            display: flex;
            gap: 35px;
            list-style: none;
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .smc-nav-links ul > li {
            position: relative;
            display: flex;
            align-items: center;
            height: 100%;
        }
        .smc-nav-links ul > li > a {
            color: var(--smc-text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            font-family: var(--smc-font-heading);
            position: relative;
            padding: 10px 0;
        }

        /* Underline Animation */
        .smc-nav-links ul > li > a::after {
            content: '';
            position: absolute;
            bottom: 0px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--smc-purple);
            transition: width 0.3s ease;
        }
        .smc-nav-links ul > li:hover > a::after {
            width: 100%;
        }
        .smc-nav-links ul > li:hover > a {
            color: var(--smc-purple);
        }

        /* Mega Menu Dropdown */
        .smc-nav-links ul li .sub-menu {
            position: fixed;
            left: 0;
            top: 110px; /* Adjust based on top bar + header height */
            width: 100vw;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: none;
            padding: 40px 10%;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            border-top: 1px solid #eee;
            z-index: 999;
        }

        .smc-nav-links ul li:hover .sub-menu {
            display: grid;
        }

        .smc-nav-links .sub-menu li {
            display: block;
            height: auto;
        }
        .smc-nav-links .sub-menu li a {
            padding: 8px 0;
            font-size: 14px;
            color: var(--smc-text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .smc-nav-links .sub-menu li a:hover {
            color: var(--smc-purple);
        }

        /* Right Side Actions */
        .smc-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .smc-login-link {
            color: var(--smc-text-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s;
        }
        .smc-login-link:hover {
            color: var(--smc-purple);
        }
        .smc-login-link i {
            font-size: 12px;
        }

        .smc-cta-btn {
            background-color: var(--smc-orange);
            color: #ffffff !important;
            padding: 12px 28px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 109, 67, 0.2);
        }
        .smc-cta-btn:hover {
            background-color: #e6552e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 109, 67, 0.3);
        }

        @media (max-width: 1024px) {
            .smc-nav-links, .smc-login-link { display: none; }
        }
    </style>
</head>

<?php
$object_id      = get_queried_object_id();
$c_page_id      = Avada()->fusion_library->get_page_id();
$wrapper_class  = 'fusion-wrapper';
$wrapper_class .= ( is_page_template( 'blank.php' ) ) ? ' wrapper_blank' : '';
?>
<body <?php body_class(); ?> <?php fusion_element_attributes( 'body' ); ?>>
	<?php do_action( 'avada_before_body_content' ); ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'Avada' ); ?></a>

	<div id="boxed-wrapper">
		<div id="wrapper" class="<?php echo esc_attr( $wrapper_class ); ?>">
			<div id="home" style="position:relative;top:-1px;"></div>
            
            <!-- START SMC CUSTOM HEADER -->
            <div class="smc-header-container">
                <div class="smc-top-bar">
                    <div class="fusion-row">
                        <span>World-Class Business Science for the African Context. <a href="#">Take the assessment</a></span>
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
                                'depth'          => 2, // Ensure sub-menus are included for mega-menu
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
            <!-- END SMC CUSTOM HEADER -->

            <!-- END SMC CUSTOM HEADER -->

			<?php if ( ! is_page_template( 'template-home.php' ) ) : ?>
                <?php avada_current_page_title_bar( $c_page_id ); ?>
            <?php endif; ?>

			<?php
			$row_css    = '';
			$main_class = '';

			if ( apply_filters( 'fusion_is_hundred_percent_template', false, $c_page_id ) ) {
				$row_css    = 'max-width:100%;';
				$main_class = 'width-100';
			}

			if ( fusion_get_option( 'content_bg_full' ) && 'no' !== fusion_get_option( 'content_bg_full' ) ) {
				$main_class .= ' full-bg';
			}
			do_action( 'avada_before_main_container' );
			?>
			<main id="main" class="clearfix <?php echo esc_attr( $main_class ); ?>">
				<div class="fusion-row" style="<?php echo esc_attr( $row_css ); ?>">
