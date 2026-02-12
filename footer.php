<?php
/**
 * The footer template for SMC Child Theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_builder = ( function_exists( 'fusion_is_preview_frame' ) && fusion_is_preview_frame() ) || ( function_exists( 'fusion_is_builder_frame' ) && fusion_is_builder_frame() );
?>
					<?php do_action( 'avada_after_main_content' ); ?>

				</div>  <!-- fusion-row -->
			</main>  <!-- #main -->
			<?php do_action( 'avada_after_main_container' ); ?>

            <!-- SMC CUSTOM FOOTER -->
            <footer class="smc-footer">
                <div class="smc-footer-container">
                    <!-- Column 1: Brand & Social -->
                    <div class="smc-footer-column smc-footer-brand">
                        <div class="footer-logo">
                            <img src="<?php echo home_url('/wp-content/uploads/2026/01/smc_logo_cropped-1.png'); ?>" alt="SMC Logo">
                        </div>
                        <p>World-Class Business Science for the African Context. We empower leaders with data-driven insights and scalable business models.</p>
                        <div class="smc-social-links">
                            <?php
                            $networks = array(
                                'linkedin'  => 'fab fa-linkedin-in',
                                'twitter'   => 'fab fa-twitter',
                                'facebook'  => 'fab fa-facebook-f',
                                'instagram' => 'fab fa-instagram',
                                'tiktok'    => 'fab fa-tiktok',
                            );

                            foreach ( $networks as $key => $icon ) {
                                $link = get_theme_mod( "smc_social_$key" );
                                if ( ! empty( $link ) ) {
                                    echo '<a href="' . esc_url( $link ) . '"><i class="' . esc_attr( $icon ) . '"></i></a>';
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Column 2: About Us -->
                    <div class="smc-footer-column">
                        <h4>About Us</h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer_col_1',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => false,
                        ) );
                        ?>
                    </div>

                    <!-- Column 3: Assessment Tools -->
                    <div class="smc-footer-column">
                        <h4>Assessment Tools</h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer_col_2',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => false,
                        ) );
                        ?>
                    </div>

                    <!-- Column 4: Training & Proficiency -->
                    <div class="smc-footer-column">
                        <h4>Training</h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer_col_3',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => false,
                        ) );
                        ?>
                        <ul class="footer-menu smc-extra-footer-links">
                            <li><a href="<?php echo home_url('/learning/'); ?>"><?php _e( 'My Learning Dashboard', 'smc' ); ?></a></li>
                            <?php if ( current_user_can( 'manage_options' ) ) : ?>
                                <li><a href="<?php echo home_url('/instructor/'); ?>"><?php _e( 'Instructor Hub', 'smc' ); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Column 5: Offices -->
                    <div class="smc-footer-column smc-footer-offices">
                        <h4>Our Offices</h4>
                        <div class="office-address">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>4th Floor, Three Anchor House Building, 54 Jason Moyo Avenue, Harare, Zimbabwe</p>
                        </div>
                    </div>
                </div>

                <div class="smc-footer-bottom">
                    <div class="smc-footer-container">
                        <div class="footer-copyright">
                            &copy; <?php echo date('Y'); ?> Social Marketing Centre. All rights reserved. Design &amp; Built by <a href="https://zimpricecheck.com" target="_blank" rel="noopener noreferrer">Zimpricecheck</a>
                        </div>
                        <div class="footer-bottom-links">
                            <a href="/privacy-policy">Privacy Policy</a>
                            <a href="/terms-of-service">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END SMC CUSTOM FOOTER -->

			<?php do_action( 'avada_before_wrapper_container_close' ); ?>
		</div> <!-- wrapper -->
	</div> <!-- #boxed-wrapper -->

	<a class="fusion-one-page-text-link fusion-page-load-link" tabindex="-1" href="#" aria-hidden="true"><?php esc_html_e( 'Page load link', 'Avada' ); ?></a>

	<div class="avada-footer-scripts">
		<?php wp_footer(); ?>
	</div>

	<?php get_template_part( 'templates/to-top' ); ?>
</body>
</html>
