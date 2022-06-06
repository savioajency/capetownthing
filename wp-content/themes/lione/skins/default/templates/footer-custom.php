<?php
/**
 * The template to display default site footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */

$lione_footer_id = lione_get_custom_footer_id();
$lione_footer_meta = get_post_meta( $lione_footer_id, 'trx_addons_options', true );
if ( ! empty( $lione_footer_meta['margin'] ) ) {
	lione_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( lione_prepare_css_value( $lione_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $lione_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $lione_footer_id ) ) ); ?>
						<?php
						$lione_footer_scheme = lione_get_theme_option( 'footer_scheme' );
						if ( ! empty( $lione_footer_scheme ) && ! lione_is_inherit( $lione_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $lione_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'lione_action_show_layout', $lione_footer_id );
	?>
</footer><!-- /.footer_wrap -->
