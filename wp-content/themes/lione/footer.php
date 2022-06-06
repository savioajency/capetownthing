<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package LIONE
 * @since LIONE 1.0
 */

							do_action( 'lione_action_page_content_end_text' );
							
							// Widgets area below the content
							lione_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'lione_action_page_content_end' );
							?>
						</div>
						<?php

						// Show main sidebar
						get_sidebar();
						?>
					</div>
					<?php

					do_action( 'lione_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$lione_body_style = lione_get_theme_option( 'body_style' );
					$lione_widgets_name = lione_get_theme_option( 'widgets_below_page' );
					$lione_show_widgets = ! lione_is_off( $lione_widgets_name ) && is_active_sidebar( $lione_widgets_name );
					$lione_show_related = lione_is_single() && lione_get_theme_option( 'related_position' ) == 'below_page';
					if ( $lione_show_widgets || $lione_show_related ) {
						if ( 'fullscreen' != $lione_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $lione_show_related ) {
							do_action( 'lione_action_related_posts' );
						}

						// Widgets area below page content
						if ( $lione_show_widgets ) {
							lione_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $lione_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'lione_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'lione_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! lione_is_singular( 'post' ) && ! lione_is_singular( 'attachment' ) ) || ! in_array ( lione_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="lione_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'lione_action_before_footer' );

				// Footer
				$lione_footer_type = lione_get_theme_option( 'footer_type' );
				if ( 'custom' == $lione_footer_type && ! lione_is_layouts_available() ) {
					$lione_footer_type = 'default';
				}
				get_template_part( apply_filters( 'lione_filter_get_template_part', "templates/footer-" . sanitize_file_name( $lione_footer_type ) ) );

				do_action( 'lione_action_after_footer' );

			}
			?>

			<?php do_action( 'lione_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'lione_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'lione_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>