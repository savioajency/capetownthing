<?php
/**
 * The template to display single post
 *
 * @package LIONE
 * @since LIONE 1.0
 */

// Full post loading
$full_post_loading          = lione_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = lione_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = lione_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$lione_related_position   = lione_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$lione_posts_navigation   = lione_get_theme_option( 'posts_navigation' );
$lione_prev_post          = false;
$lione_prev_post_same_cat = lione_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( lione_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	lione_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'lione_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $lione_posts_navigation ) {
		$lione_prev_post = get_previous_post( $lione_prev_post_same_cat );  // Get post from same category
		if ( ! $lione_prev_post && $lione_prev_post_same_cat ) {
			$lione_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $lione_prev_post ) {
			$lione_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $lione_prev_post ) ) {
		lione_sc_layouts_showed( 'featured', false );
		lione_sc_layouts_showed( 'title', false );
		lione_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $lione_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/content', 'single-' . lione_get_theme_option( 'single_style' ) ), 'single-' . lione_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $lione_related_position, 'inside' ) === 0 ) {
		$lione_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'lione_action_related_posts' );
		$lione_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $lione_related_content ) ) {
			$lione_related_position_inside = max( 0, min( 9, lione_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $lione_related_position_inside ) {
				$lione_related_position_inside = mt_rand( 1, 9 );
			}

			$lione_p_number         = 0;
			$lione_related_inserted = false;
			$lione_in_block         = false;
			$lione_content_start    = strpos( $lione_content, '<div class="post_content' );
			$lione_content_end      = strrpos( $lione_content, '</div>' );

			for ( $i = max( 0, $lione_content_start ); $i < min( strlen( $lione_content ) - 3, $lione_content_end ); $i++ ) {
				if ( $lione_content[ $i ] != '<' ) {
					continue;
				}
				if ( $lione_in_block ) {
					if ( strtolower( substr( $lione_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$lione_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $lione_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $lione_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$lione_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $lione_content[ $i + 1 ] && in_array( $lione_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$lione_p_number++;
					if ( $lione_related_position_inside == $lione_p_number ) {
						$lione_related_inserted = true;
						$lione_content = ( $i > 0 ? substr( $lione_content, 0, $i ) : '' )
											. $lione_related_content
											. substr( $lione_content, $i );
					}
				}
			}
			if ( ! $lione_related_inserted ) {
				if ( $lione_content_end > 0 ) {
					$lione_content = substr( $lione_content, 0, $lione_content_end ) . $lione_related_content . substr( $lione_content, $lione_content_end );
				} else {
					$lione_content .= $lione_related_content;
				}
			}
		}

		lione_show_layout( $lione_content );
	}

	// Comments
	do_action( 'lione_action_before_comments' );
	comments_template();
	do_action( 'lione_action_after_comments' );

	// Related posts
	if ( 'below_content' == $lione_related_position
		&& ( 'scroll' != $lione_posts_navigation || lione_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || lione_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'lione_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $lione_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $lione_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $lione_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $lione_prev_post ) ); ?>"
			<?php do_action( 'lione_action_nav_links_single_scroll_data', $lione_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
