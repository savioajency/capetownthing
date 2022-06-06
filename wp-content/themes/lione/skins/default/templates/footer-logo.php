<?php
/**
 * The template to display the site logo in the footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */

// Logo
if ( lione_is_on( lione_get_theme_option( 'logo_in_footer' ) ) ) {
	$lione_logo_image = lione_get_logo_image( 'footer' );
	$lione_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $lione_logo_image['logo'] ) || ! empty( $lione_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $lione_logo_image['logo'] ) ) {
					$lione_attr = lione_getimagesize( $lione_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $lione_logo_image['logo'] ) . '"'
								. ( ! empty( $lione_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $lione_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'lione' ) . '"'
								. ( ! empty( $lione_attr[3] ) ? ' ' . wp_kses_data( $lione_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $lione_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $lione_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
