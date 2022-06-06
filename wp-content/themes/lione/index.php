<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package LIONE
 * @since LIONE 1.0
 */

$lione_template = apply_filters( 'lione_filter_get_template_part', lione_blog_archive_get_template() );

if ( ! empty( $lione_template ) && 'index' != $lione_template ) {

	get_template_part( $lione_template );

} else {

	lione_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$lione_stickies   = is_home()
								|| ( in_array( lione_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) lione_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$lione_post_type  = lione_get_theme_option( 'post_type' );
		$lione_args       = array(
								'blog_style'     => lione_get_theme_option( 'blog_style' ),
								'post_type'      => $lione_post_type,
								'taxonomy'       => lione_get_post_type_taxonomy( $lione_post_type ),
								'parent_cat'     => lione_get_theme_option( 'parent_cat' ),
								'posts_per_page' => lione_get_theme_option( 'posts_per_page' ),
								'sticky'         => lione_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $lione_stickies )
															&& count( $lione_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		lione_blog_archive_start();

		do_action( 'lione_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'lione_action_before_page_author' );
			get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'lione_action_after_page_author' );
		}

		if ( lione_get_theme_option( 'show_filters' ) ) {
			do_action( 'lione_action_before_page_filters' );
			lione_show_filters( $lione_args );
			do_action( 'lione_action_after_page_filters' );
		} else {
			do_action( 'lione_action_before_page_posts' );
			lione_show_posts( array_merge( $lione_args, array( 'cat' => $lione_args['parent_cat'] ) ) );
			do_action( 'lione_action_after_page_posts' );
		}

		do_action( 'lione_action_blog_archive_end' );

		lione_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
