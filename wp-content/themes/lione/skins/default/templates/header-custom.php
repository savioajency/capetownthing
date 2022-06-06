<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package LIONE
 * @since LIONE 1.0.06
 */

$lione_header_css   = '';
$lione_header_image = get_header_image();
$lione_header_video = lione_get_header_video();
if ( ! empty( $lione_header_image ) && lione_trx_addons_featured_image_override( is_singular() || lione_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$lione_header_image = lione_get_current_mode_image( $lione_header_image );
}

$lione_header_id = lione_get_custom_header_id();
$lione_header_meta = get_post_meta( $lione_header_id, 'trx_addons_options', true );
if ( ! empty( $lione_header_meta['margin'] ) ) {
	lione_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( lione_prepare_css_value( $lione_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $lione_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $lione_header_id ) ) ); ?>
				<?php
				echo ! empty( $lione_header_image ) || ! empty( $lione_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $lione_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $lione_header_image ) {
					echo ' ' . esc_attr( lione_add_inline_css_class( 'background-image: url(' . esc_url( $lione_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( lione_is_on( lione_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight lione-full-height';
				}
				$lione_header_scheme = lione_get_theme_option( 'header_scheme' );
				if ( ! empty( $lione_header_scheme ) && ! lione_is_inherit( $lione_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $lione_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $lione_header_video ) ) {
		get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'lione_action_show_layout', $lione_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
