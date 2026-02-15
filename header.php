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
                        <?php if ( is_user_logged_in() ) : $current_user = wp_get_current_user(); ?>
                            <span>Welcome back, <strong><?php echo esc_html( $current_user->display_name ); ?></strong>. <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>">View Your Business Health Record &rarr;</a></span>
                        <?php else : ?>
                            <span>World-Class Business Science for the African Context. <a href="<?php echo esc_url( home_url( '/free-assessment/' ) ); ?>">Get Your Free Business Score &rarr;</a></span>
                        <?php endif; ?>
                    </div>
                </div>
                <header class="smc-main-nav">
                     <div class="smc-logo-container">
                         <a href="<?php echo esc_url( home_url() ); ?>">
                             <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/01/smc_logo_cropped-1.png' ) ); ?>" alt="SMC Logo">
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
                         <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="smc-shop-link">
                             <i data-lucide="shopping-bag"></i> <span><?php echo __( 'Shop', 'smc' ); ?></span>
                         </a>

                         <?php if ( is_user_logged_in() ) : 
                             $current_user = wp_get_current_user();
                             $can_access_instructor_hub = in_array( 'administrator', (array) $current_user->roles, true ) || in_array( 'editor', (array) $current_user->roles, true );
                         ?>
                             <a href="<?php echo esc_url( home_url( '/learning/' ) ); ?>" class="smc-learning-link" title="My Learning">
                                 <i data-lucide="book-open"></i>
                             </a>
                             
                             <?php if ( $can_access_instructor_hub ) : ?>
                                 <a href="<?php echo esc_url( home_url( '/instructor/' ) ); ?>" class="smc-instructor-link" title="Instructor Hub">
                                     <i data-lucide="layout-dashboard"></i>
                                 </a>
                             <?php endif; ?>

                             <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="smc-login-link logged-in">
                                 <i data-lucide="user"></i> <?php echo esc_html( $current_user->display_name ); ?>
                             </a>
                         <?php else : ?>
                             <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="smc-login-link">
                                 <i class="fas fa-arrow-right"></i> LOG IN
                             </a>
                         <?php endif; ?>
                         <button type="button" class="smc-mobile-toggle" aria-controls="smc-mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'smc' ); ?>">
                             <span></span>
                             <span></span>
                             <span></span>
                         </button>
                     </div>
                </header>
            </div>
            <!-- Mobile Menu Structure -->
            <button type="button" class="smc-mobile-overlay" aria-label="<?php esc_attr_e( 'Close menu', 'smc' ); ?>"></button>
            <aside id="smc-mobile-menu" class="smc-mobile-menu" aria-hidden="true">
                <div class="smc-mobile-header">
                    <div class="smc-mobile-actions">
                        <button type="button" class="smc-mobile-close" aria-label="<?php esc_attr_e( 'Close menu', 'smc' ); ?>">
                            <i data-lucide="x"></i>
                        </button>
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
                            <a href="<?php echo esc_url( home_url( '/learning/' ) ); ?>" class="profile-link-btn">My Learning <i data-lucide="book-open"></i></a>
                            <?php if ( $can_access_instructor_hub ) : ?>
                                <a href="<?php echo esc_url( home_url( '/instructor/' ) ); ?>" class="profile-link-btn">Instructor Hub <i data-lucide="layout-dashboard"></i></a>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="profile-link-btn">Account Settings <i data-lucide="user"></i></a>
                        <?php else : ?>
                            <div class="profile-info logged-out">
                                <span class="welcome-text">Welcome to SMC</span>
                                <span class="user-name">Guest</span>
                            </div>
                            <div class="auth-buttons">
                                <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="btn-login">Sign In</a>
                                <a href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" class="btn-register">Register</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="smc-mobile-scroll">
                    <form role="search" method="get" class="smc-mobile-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <label class="screen-reader-text" for="smc-mobile-search-input"><?php esc_html_e( 'Search the site', 'smc' ); ?></label>
                        <input id="smc-mobile-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search resources, tools, and articles', 'smc' ); ?>" />
                        <button type="submit" aria-label="<?php esc_attr_e( 'Submit search', 'smc' ); ?>">
                            <i data-lucide="search"></i>
                        </button>
                    </form>

                    <div class="smc-mobile-quick-tools">
                        <a href="<?php echo esc_url( home_url( '/free-assessment/' ) ); ?>" class="smc-mobile-tool-link"><i data-lucide="clipboard-check"></i><span>Free Assessment</span></a>
                        <a href="<?php echo esc_url( home_url( '/articles/' ) ); ?>" class="smc-mobile-tool-link"><i data-lucide="newspaper"></i><span>Articles</span></a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="smc-mobile-tool-link"><i data-lucide="message-circle"></i><span>Contact</span></a>
                    </div>

                    <nav class="mobile-nav-container">
                        <span class="nav-label">MENU</span>
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'top_menu',
                                'container'      => false,
                                'menu_class'     => 'smcmobile-links',
                                'fallback_cb'    => '__return_empty_string',
                                'depth'          => 2,
                            ) );
                        ?>
                    </nav>

                    <div class="smc-mobile-recent" hidden>
                        <span class="nav-label">RECENTLY VISITED</span>
                        <ul class="smc-mobile-recent-list"></ul>
                    </div>
                </div>

                <div class="mobile-menu-footer">
                    <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="mobile-cta-btn">
                        <span>Explore The SMC Shop</span>
                        <i data-lucide="arrow-right"></i>
                    </a>
                </div>
            </aside>
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
