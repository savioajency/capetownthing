<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package LIONE
 * @since LIONE 1.0
 */

$lione_template_args = get_query_var( 'lione_template_args' );
$lione_columns = 1;
if ( is_array( $lione_template_args ) ) {
	$lione_columns    = empty( $lione_template_args['columns'] ) ? 1 : max( 1, $lione_template_args['columns'] );
	$lione_blog_style = array( $lione_template_args['type'], $lione_columns );
	if ( ! empty( $lione_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $lione_columns > 1 ) {
	    $lione_columns_class = lione_get_column_class( 1, $lione_columns, ! empty( $lione_template_args['columns_tablet']) ? $lione_template_args['columns_tablet'] : '', ! empty($lione_template_args['columns_mobile']) ? $lione_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $lione_columns_class ); ?>">
		<?php
	}
}
$lione_expanded    = ! lione_sidebar_present() && lione_get_theme_option( 'expand_content' ) == 'expand';
$lione_post_format = get_post_format();
$lione_post_format = empty( $lione_post_format ) ? 'standard' : str_replace( 'post-format-', '', $lione_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $lione_post_format ) );
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
								: array_map( 'trim', explode( ',', $lione_template_args['meta_parts'] ) )
								)
							: lione_array_get_keys_by_value( lione_get_theme_option( 'meta_parts' ) );
	lione_show_post_featured( apply_filters( 'lione_filter_args_featured',
		array(
			'no_links'   => ! empty( $lione_template_args['no_links'] ),
			'hover'      => $lione_hover,
			'meta_parts' => $lione_components,
			'thumb_size' => ! empty( $lione_template_args['thumb_size'] )
							? $lione_template_args['thumb_size']
							: lione_get_thumb_size( strpos( lione_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $lione_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$lione_template_args
	) );

	// Title and post meta
	$lione_show_title = get_the_title() != '';
	$lione_show_meta  = count( $lione_components ) > 0 && ! in_array( $lione_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $lione_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'lione_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'lione_action_before_post_title' );
				if ( empty( $lione_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'lione_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'lione_filter_show_blog_excerpt', empty( $lione_template_args['hide_excerpt'] ) && lione_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'lione_filter_show_blog_meta', $lione_show_meta, $lione_components, 'excerpt' ) ) {
				if ( count( $lione_components ) > 0 ) {
					do_action( 'lione_action_before_post_meta' );
					lione_show_post_meta(
						apply_filters(
							'lione_filter_post_meta_args', array(
								'components' => join( ',', $lione_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'lione_action_after_post_meta' );
				}
			}

			if ( lione_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'lione_action_before_full_post_content' );
					the_content( '' );
					do_action( 'lione_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'lione' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lione' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				lione_show_post_content( $lione_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'lione_filter_show_blog_readmore',  ! isset( $lione_template_args['more_button'] ) || ! empty( $lione_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $lione_template_args['no_links'] ) ) {
					do_action( 'lione_action_before_post_readmore' );
					if ( lione_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						lione_show_post_more_link( $lione_template_args, '<p>', '</p>' );
					} else {
						lione_show_post_comments_link( $lione_template_args, '<p>', '</p>' );
					}
					do_action( 'lione_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $lione_template_args ) ) {
	if ( ! empty( $lione_template_args['slider'] ) || $lione_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
