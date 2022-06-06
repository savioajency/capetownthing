<?php
/**
 * The template to display the widgets area in the header
 *
 * @package LIONE
 * @since LIONE 1.0
 */

// Header sidebar
$lione_header_name    = lione_get_theme_option( 'header_widgets' );
$lione_header_present = ! lione_is_off( $lione_header_name ) && is_active_sidebar( $lione_header_name );
if ( $lione_header_present ) {
	lione_storage_set( 'current_sidebar', 'header' );
	$lione_header_wide = lione_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $lione_header_name ) ) {
		dynamic_sidebar( $lione_header_name );
	}
	$lione_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $lione_widgets_output ) ) {
		$lione_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $lione_widgets_output );
		$lione_need_columns   = strpos( $lione_widgets_output, 'columns_wrap' ) === false;
		if ( $lione_need_columns ) {
			$lione_columns = max( 0, (int) lione_get_theme_option( 'header_columns' ) );
			if ( 0 == $lione_columns ) {
				$lione_columns = min( 6, max( 1, lione_tags_count( $lione_widgets_output, 'aside' ) ) );
			}
			if ( $lione_columns > 1 ) {
				$lione_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $lione_columns ) . ' widget', $lione_widgets_output );
			} else {
				$lione_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $lione_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'lione_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $lione_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $lione_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'lione_action_before_sidebar', 'header' );
				lione_show_layout( $lione_widgets_output );
				do_action( 'lione_action_after_sidebar', 'header' );
				if ( $lione_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $lione_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'lione_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
