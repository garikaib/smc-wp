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
    <!-- Custom SMC Header Styles -->
    <!-- Styles moved to style.css -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('.smc-mobile-toggle');
            const menu = document.querySelector('.smc-mobile-menu');
            const overlay = document.querySelector('.smc-mobile-overlay');
            const closeBtn = document.querySelector('.smc-mobile-close');

            function openMenu() {
                menu.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
                
                // Staggered Animation for Links
                const links = document.querySelectorAll('.smcmobile-links > li');
                links.forEach((link, index) => {
                    link.style.animationDelay = `${index * 0.05}s`;
                    link.classList.add('slide-in');
                });
            }

            function closeMenu() {
                menu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
                
                const links = document.querySelectorAll('.smcmobile-links > li');
                links.forEach(link => {
                    link.classList.remove('slide-in');
                    link.style.animationDelay = '0s';
                });
            }

            if (toggle) toggle.addEventListener('click', openMenu);
            if (closeBtn) closeBtn.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);

            // Inject Lucide Icons based on text
            const menuItems = document.querySelectorAll('.smcmobile-links li a');
            menuItems.forEach(item => {
                const text = item.textContent.trim().toLowerCase();
                let iconName = 'chevron-right'; // Default

                if (text.includes('home')) iconName = 'house';
                else if (text.includes('about')) iconName = 'info';
                else if (text.includes('contact')) iconName = 'mail';
                else if (text.includes('assess')) iconName = 'clipboard-list';
                else if (text.includes('article') || text.includes('blog')) iconName = 'book-open';
                else if (text.includes('service')) iconName = 'briefcase';

                // Create Icon Element if not exists
                if (!item.querySelector('.nav-icon')) {
                    const icon = document.createElement('i');
                    icon.setAttribute('data-lucide', iconName);
                    icon.classList.add('nav-icon');
                    item.prepend(icon);
                }
            });

            // Re-render icons if Lucide is loaded
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
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
                                'menu_class'     => 'smclinks',
                                'fallback_cb'    => '__return_empty_string',
                                'depth'          => 2,
                            ) );
                         ?>
                     </nav>

                     <div class="smc-actions">
                         <a href="<?php echo home_url('/shop/'); ?>" class="smc-shop-link">
                             <i data-lucide="shopping-bag"></i> <span><?php echo __( 'Shop', 'smc' ); ?></span>
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
                         <div class="smc-mobile-toggle">
                             <span></span>
                             <span></span>
                             <span></span>
                         </div>
                     </div>
                </header>
            </div>
            <!-- Mobile Menu Structure -->
            <div class="smc-mobile-overlay"></div>
            <div class="smc-mobile-menu">
                <div class="smc-mobile-header">
                    <div class="smc-mobile-actions">
                        <div class="smc-mobile-close">
                            <i data-lucide="x"></i>
                        </div>
                    </div>
                    <!-- Profile Section at Top -->
                    <div class="mobile-profile-card">
                        <?php if ( is_user_logged_in() ) : $current_user = wp_get_current_user(); ?>
                            <div class="profile-info">
                                <div class="profile-avatar">
                                    <?php echo get_avatar( $current_user->ID, 50 ); ?>
                                </div>
                                <div class="profile-text">
                                    <span class="welcome-text">Welcome back,</span>
                                    <span class="user-name"><?php echo esc_html( $current_user->display_name ); ?></span>
                                </div>
                            </div>
                            <a href="<?php echo home_url('/my-account/'); ?>" class="profile-link-btn">My Dashboard <i data-lucide="arrow-right"></i></a>
                        <?php else : ?>
                            <div class="profile-info logged-out">
                                <span class="welcome-text">Welcome to SMC</span>
                                <span class="user-name">Guest</span>
                            </div>
                            <div class="auth-buttons">
                                <a href="<?php echo home_url('/my-account/'); ?>" class="btn-login">Sign In</a>
                                <a href="<?php echo home_url('/my-account/'); ?>" class="btn-register">Register</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="smc-mobile-scroll">
                    <nav class="mobile-nav-container">
                        <span class="nav-label">MENU</span>
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'top_menu',
                                'container'      => false,
                                'menu_class'     => 'smcmobile-links',
                                'fallback_cb'    => '__return_empty_string',
                            ) );
                        ?>
                    </nav>
                </div>

                <div class="mobile-menu-footer">
                </div>
            </div>
            <!-- END SMC CUSTOM HEADER -->

			<?php if ( ! is_page_template( 'template-my-account.php' ) && ! is_page_template( 'template-home.php' ) && ! is_page_template( 'template-contact.php' ) && ! is_page_template( 'template-about.php' ) && ! is_page_template( 'template-assessment.php' ) ) : ?>
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
