<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package LIONE
 * @since LIONE 1.0.50
 */

$lione_template_args = get_query_var( 'lione_template_args' );
if ( is_array( $lione_template_args ) ) {
	$lione_columns    = empty( $lione_template_args['columns'] ) ? 2 : max( 1, $lione_template_args['columns'] );
	$lione_blog_style = array( $lione_template_args['type'], $lione_columns );
} else {
	$lione_blog_style = explode( '_', lione_get_theme_option( 'blog_style' ) );
	$lione_columns    = empty( $lione_blog_style[1] ) ? 2 : max( 1, $lione_blog_style[1] );
}
$lione_blog_id       = lione_get_custom_blog_id( join( '_', $lione_blog_style ) );
$lione_blog_style[0] = str_replace( 'blog-custom-', '', $lione_blog_style[0] );
$lione_expanded      = ! lione_sidebar_present() && lione_get_theme_option( 'expand_content' ) == 'expand';
$lione_components    = ! empty( $lione_template_args['meta_parts'] )
							? ( is_array( $lione_template_args['meta_parts'] )
								? join( ',', $lione_template_args['meta_parts'] )
								: $lione_template_args['meta_parts']
								)
							: lione_array_get_keys_by_value( lione_get_theme_option( 'meta_parts' ) );
$lione_post_format   = get_post_format();
$lione_post_format   = empty( $lione_post_format ) ? 'standard' : str_replace( 'post-format-', '', $lione_post_format );

$lione_blog_meta     = lione_get_custom_layout_meta( $lione_blog_id );
$lione_custom_style  = ! empty( $lione_blog_meta['scripts_required'] ) ? $lione_blog_meta['scripts_required'] : 'none';

if ( ! empty( $lione_template_args['slider'] ) || $lione_columns > 1 || ! lione_is_off( $lione_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $lione_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( lione_is_off( $lione_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $lione_custom_style ) ) . "-1_{$lione_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $lione_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $lione_columns )
					. ' post_layout_' . esc_attr( $lione_blog_style[0] )
					. ' post_layout_' . esc_attr( $lione_blog_style[0] ) . '_' . esc_attr( $lione_columns )
					. ( ! lione_is_off( $lione_custom_style )
						? ' post_layout_' . esc_attr( $lione_custom_style )
							. ' post_layout_' . esc_attr( $lione_custom_style ) . '_' . esc_attr( $lione_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'lione_action_show_layout', $lione_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $lione_template_args['slider'] ) || $lione_columns > 1 || ! lione_is_off( $lione_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
