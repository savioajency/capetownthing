<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package LIONE
 * @since LIONE 1.0
 */

$lione_template_args = get_query_var( 'lione_template_args' );

if ( is_array( $lione_template_args ) ) {
	$lione_columns    = empty( $lione_template_args['columns'] ) ? 2 : max( 1, $lione_template_args['columns'] );
	$lione_blog_style = array( $lione_template_args['type'], $lione_columns );
    $lione_columns_class = lione_get_column_class( 1, $lione_columns, ! empty( $lione_template_args['columns_tablet']) ? $lione_template_args['columns_tablet'] : '', ! empty($lione_template_args['columns_mobile']) ? $lione_template_args['columns_mobile'] : '' );
} else {
	$lione_blog_style = explode( '_', lione_get_theme_option( 'blog_style' ) );
	$lione_columns    = empty( $lione_blog_style[1] ) ? 2 : max( 1, $lione_blog_style[1] );
    $lione_columns_class = lione_get_column_class( 1, $lione_columns );
}
$lione_expanded   = ! lione_sidebar_present() && lione_get_theme_option( 'expand_content' ) == 'expand';

$lione_post_format = get_post_format();
$lione_post_format = empty( $lione_post_format ) ? 'standard' : str_replace( 'post-format-', '', $lione_post_format );

?><div class="<?php
	if ( ! empty( $lione_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( lione_is_blog_style_use_masonry( $lione_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $lione_columns ) : esc_attr( $lione_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $lione_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $lione_columns )
				. ' post_layout_' . esc_attr( $lione_blog_style[0] )
				. ' post_layout_' . esc_attr( $lione_blog_style[0] ) . '_' . esc_attr( $lione_columns )
	);
	lione_add_blog_animation( $lione_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$lione_hover      = ! empty( $lione_template_args['hover'] ) && ! lione_is_inherit( $lione_template_args['hover'] )
							? $lione_template_args['hover']
							: lione_get_theme_option( 'image_hover' );

	$lione_components = ! empty( $lione_template_args['meta_parts'] )
							? ( is_array( $lione_template_args['meta_parts'] )
								? $lione_template_args['meta_parts']
								: explode( ',', $lione_template_args['meta_parts'] )
								)
							: lione_array_get_keys_by_value( lione_get_theme_option( 'meta_parts' ) );

	lione_show_post_featured( apply_filters( 'lione_filter_args_featured',
		array(
			'thumb_size' => ! empty( $lione_template_args['thumb_size'] )
				? $lione_template_args['thumb_size']
				: lione_get_thumb_size(
					'classic' == $lione_blog_style[0]
						? ( strpos( lione_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $lione_columns > 2 ? 'big' : 'huge' )
								: ( $lione_columns > 2
									? ( $lione_expanded ? 'square' : 'square' )
									: ($lione_columns > 1 ? 'square' : ( $lione_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( lione_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $lione_columns > 2 ? 'masonry-big' : 'full' )
								: ($lione_columns === 1 ? ( $lione_expanded ? 'huge' : 'big' ) : ( $lione_columns <= 2 && $lione_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $lione_hover,
			'meta_parts' => $lione_components,
			'no_links'   => ! empty( $lione_template_args['no_links'] ),
        ),
        'content-classic',
        $lione_template_args
    ) );

	// Title and post meta
	$lione_show_title = get_the_title() != '';
	$lione_show_meta  = count( $lione_components ) > 0 && ! in_array( $lione_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $lione_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			//Post categories
			if ( apply_filters( 'lione_filter_show_blog_meta', $lione_show_meta, $lione_components, 'classic' ) && in_array('categories', $lione_components ) ) {
				if ( count( $lione_components ) > 0 ) {
					do_action( 'lione_action_before_post_meta' );
					lione_show_post_meta(
						apply_filters(
							'lione_filter_post_meta_args', array(
							'components' => 'categories',
							'seo'        => false,
							'echo'       => true,
							'class'       => 'post_categories',
						), $lione_blog_style[0], $lione_columns
						)
					);
					do_action( 'lione_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'lione_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'lione_action_before_post_title' );
				if ( empty( $lione_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'lione_action_after_post_title' );
			}
			
			// Post meta
			//Extract category from post meta
			$lione_components = array_diff( $lione_components, ['categories'] );
			if ( apply_filters( 'lione_filter_show_blog_meta', $lione_show_meta, $lione_components, 'classic' ) ) {
				if ( count( $lione_components ) > 0 ) {
					do_action( 'lione_action_before_post_meta' );
					lione_show_post_meta(
						apply_filters(
							'lione_filter_post_meta_args', array(
							'components' => join( ',', $lione_components ),
							'seo'        => false,
							'echo'       => true,
						), $lione_blog_style[0], $lione_columns
						)
					);
					do_action( 'lione_action_after_post_meta' );
				}
			}

			if( !in_array( $lione_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'lione_filter_show_blog_readmore', ! $lione_show_title || ! empty( $lione_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $lione_template_args['no_links'] ) ) {
						do_action( 'lione_action_before_post_readmore' );
						lione_show_post_more_link( $lione_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'lione_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $lione_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('lione_filter_show_blog_excerpt', empty($lione_template_args['hide_excerpt']) && lione_get_theme_option('excerpt_length') > 0, 'classic')) {
			lione_show_post_content($lione_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $lione_template_args['more_button'] )) {
			if ( empty( $lione_template_args['no_links'] ) ) {
				do_action( 'lione_action_before_post_readmore' );
				lione_show_post_more_link( $lione_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'lione_action_after_post_readmore' );
			}
		}
		$lione_content = ob_get_contents();
		ob_end_clean();
		lione_show_layout($lione_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
