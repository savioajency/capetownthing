<?php
/**
 * The Front Page template file.
 *
 * @package LIONE
 * @since LIONE 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( lione_is_on( lione_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$lione_sections = lione_array_get_keys_by_value( lione_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $lione_sections ) ) {
			foreach ( $lione_sections as $lione_section ) {
				get_template_part( apply_filters( 'lione_filter_get_template_part', 'front-page/section', $lione_section ), $lione_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'lione_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'lione_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'index' ) );
}

get_footer();
