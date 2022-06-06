<?php
/**
 * The template to display Admin notices
 *
 * @package LIONE
 * @since LIONE 1.0.64
 */

$lione_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$lione_skins_args = get_query_var( 'lione_skins_notice_args' );
?>
<div class="lione_admin_notice lione_skins_notice notice notice-info is-dismissible" data-notice="skins">
	<?php
	// Theme image
	$lione_theme_img = lione_get_file_url( 'screenshot.jpg' );
	if ( '' != $lione_theme_img ) {
		?>
		<div class="lione_notice_image"><img src="<?php echo esc_url( $lione_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'lione' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="lione_notice_title">
		<?php esc_html_e( 'New skins available', 'lione' ); ?>
	</h3>
	<?php

	// Description
	$lione_total      = $lione_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$lione_skins_msg  = $lione_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $lione_total, 'lione' ), $lione_total ) . '</strong>'
							: '';
	$lione_total      = $lione_skins_args['free'];
	$lione_skins_msg .= $lione_total > 0
							? ( ! empty( $lione_skins_msg ) ? ' ' . esc_html__( 'and', 'lione' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $lione_total, 'lione' ), $lione_total ) . '</strong>'
							: '';
	$lione_total      = $lione_skins_args['pay'];
	$lione_skins_msg .= $lione_skins_args['pay'] > 0
							? ( ! empty( $lione_skins_msg ) ? ' ' . esc_html__( 'and', 'lione' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $lione_total, 'lione' ), $lione_total ) . '</strong>'
							: '';
	?>
	<div class="lione_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'lione' ), $lione_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="lione_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $lione_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'lione' );
			?>
		</a>
	</div>
</div>
