<?php
/**
 * The template to display default site header
 *
 * @package LIONE
 * @since LIONE 1.0
 */

$lione_header_css   = '';
$lione_header_image = get_header_image();
$lione_header_video = lione_get_header_video();
if ( ! empty( $lione_header_image ) && lione_trx_addons_featured_image_override( is_singular() || lione_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$lione_header_image = lione_get_current_mode_image( $lione_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $lione_header_image ) || ! empty( $lione_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( lione_is_on( lione_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
