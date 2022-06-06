<?php
/**
 * The Portfolio template to display the content
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

$lione_post_format = get_post_format();
$lione_post_format = empty( $lione_post_format ) ? 'standard' : str_replace( 'post-format-', '', $lione_post_format );

?><div class="
<?php
if ( ! empty( $lione_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( lione_is_blog_style_use_masonry( $lione_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $lione_columns ) : esc_attr( $lione_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $lione_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $lione_columns )
		. ( 'portfolio' != $lione_blog_style[0] ? ' ' . esc_attr( $lione_blog_style[0] )  . '_' . esc_attr( $lione_columns ) : '' )
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

	$lione_hover   = ! empty( $lione_template_args['hover'] ) && ! lione_is_inherit( $lione_template_args['hover'] )
								? $lione_template_args['hover']
								: lione_get_theme_option( 'image_hover' );

	if ( 'dots' == $lione_hover ) {
		$lione_post_link = empty( $lione_template_args['no_links'] )
								? ( ! empty( $lione_template_args['link'] )
									? $lione_template_args['link']
									: get_permalink()
									)
								: '';
		$lione_target    = ! empty( $lione_post_link ) && false === strpos( $lione_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$lione_components = ! empty( $lione_template_args['meta_parts'] )
							? ( is_array( $lione_template_args['meta_parts'] )
								? $lione_template_args['meta_parts']
								: explode( ',', $lione_template_args['meta_parts'] )
								)
							: lione_array_get_keys_by_value( lione_get_theme_option( 'meta_parts' ) );

	// Featured image
	lione_show_post_featured( apply_filters( 'lione_filter_args_featured',
        array(
			'hover'         => $lione_hover,
			'no_links'      => ! empty( $lione_template_args['no_links'] ),
			'thumb_size'    => ! empty( $lione_template_args['thumb_size'] )
								? $lione_template_args['thumb_size']
								: lione_get_thumb_size(
									lione_is_blog_style_use_masonry( $lione_blog_style[0] )
										? (	strpos( lione_get_theme_option( 'body_style' ), 'full' ) !== false || $lione_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( lione_get_theme_option( 'body_style' ), 'full' ) !== false || $lione_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => lione_is_blog_style_use_masonry( $lione_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $lione_components,
			'class'         => 'dots' == $lione_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $lione_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $lione_post_link )
												? '<a href="' . esc_url( $lione_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $lione_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $lione_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $lione_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!