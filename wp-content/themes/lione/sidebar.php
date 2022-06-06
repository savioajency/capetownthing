<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package LIONE
 * @since LIONE 1.0
 */

if ( lione_sidebar_present() ) {
	
	$lione_sidebar_type = lione_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $lione_sidebar_type && ! lione_is_layouts_available() ) {
		$lione_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $lione_sidebar_type ) {
		// Default sidebar with widgets
		$lione_sidebar_name = lione_get_theme_option( 'sidebar_widgets' );
		lione_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $lione_sidebar_name ) ) {
			dynamic_sidebar( $lione_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$lione_sidebar_id = lione_get_custom_sidebar_id();
		do_action( 'lione_action_show_layout', $lione_sidebar_id );
	}
	$lione_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $lione_out ) ) {
		$lione_sidebar_position    = lione_get_theme_option( 'sidebar_position' );
		$lione_sidebar_position_ss = lione_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $lione_sidebar_position );
			echo ' sidebar_' . esc_attr( $lione_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $lione_sidebar_type );

			if ( 'float' == $lione_sidebar_position_ss ) {
				echo ' sidebar_float';
			}
			$lione_sidebar_scheme = lione_get_theme_option( 'sidebar_scheme' );
			if ( ! empty( $lione_sidebar_scheme ) && ! lione_is_inherit( $lione_sidebar_scheme ) ) {
				echo ' scheme_' . esc_attr( $lione_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="lione_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'lione_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $lione_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$lione_title = apply_filters( 'lione_filter_sidebar_control_title', 'float' == $lione_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'lione' ) : '' );
				$lione_text  = apply_filters( 'lione_filter_sidebar_control_text', 'above' == $lione_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'lione' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $lione_title ); ?>"><?php echo esc_html( $lione_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'lione_action_before_sidebar', 'sidebar' );
				lione_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $lione_out ) );
				do_action( 'lione_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'lione_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
