<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package LIONE
 * @since LIONE 1.0
 */

$lione_args = get_query_var( 'lione_logo_args' );

// Site logo
$lione_logo_type   = isset( $lione_args['type'] ) ? $lione_args['type'] : '';
$lione_logo_image  = lione_get_logo_image( $lione_logo_type );
$lione_logo_text   = lione_is_on( lione_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$lione_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $lione_logo_image['logo'] ) || ! empty( $lione_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $lione_logo_image['logo'] ) ) {
			if ( empty( $lione_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($lione_logo_image['logo']) && (int) $lione_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$lione_attr = lione_getimagesize( $lione_logo_image['logo'] );
				echo '<img src="' . esc_url( $lione_logo_image['logo'] ) . '"'
						. ( ! empty( $lione_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $lione_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $lione_logo_text ) . '"'
						. ( ! empty( $lione_attr[3] ) ? ' ' . wp_kses_data( $lione_attr[3] ) : '' )
						. '>';
			}
		} else {
			lione_show_layout( lione_prepare_macros( $lione_logo_text ), '<span class="logo_text">', '</span>' );
			lione_show_layout( lione_prepare_macros( $lione_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
