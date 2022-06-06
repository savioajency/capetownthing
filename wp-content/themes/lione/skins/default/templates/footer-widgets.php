<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */

// Footer sidebar
$lione_footer_name    = lione_get_theme_option( 'footer_widgets' );
$lione_footer_present = ! lione_is_off( $lione_footer_name ) && is_active_sidebar( $lione_footer_name );
if ( $lione_footer_present ) {
	lione_storage_set( 'current_sidebar', 'footer' );
	$lione_footer_wide = lione_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $lione_footer_name ) ) {
		dynamic_sidebar( $lione_footer_name );
	}
	$lione_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $lione_out ) ) {
		$lione_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $lione_out );
		$lione_need_columns = true;   //or check: strpos($lione_out, 'columns_wrap')===false;
		if ( $lione_need_columns ) {
			$lione_columns = max( 0, (int) lione_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $lione_columns ) {
				$lione_columns = min( 4, max( 1, lione_tags_count( $lione_out, 'aside' ) ) );
			}
			if ( $lione_columns > 1 ) {
				$lione_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $lione_columns ) . ' widget', $lione_out );
			} else {
				$lione_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $lione_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'lione_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $lione_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $lione_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'lione_action_before_sidebar', 'footer' );
				lione_show_layout( $lione_out );
				do_action( 'lione_action_after_sidebar', 'footer' );
				if ( $lione_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $lione_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'lione_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
