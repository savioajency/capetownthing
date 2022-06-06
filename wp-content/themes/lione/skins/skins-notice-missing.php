<?php
/**
 * The template to display Admin notices
 *
 * @package LIONE
 * @since LIONE 1.98.0
 */

$lione_skins_url   = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$lione_active_skin = lione_skins_get_active_skin_name();
?>
<div class="lione_admin_notice lione_skins_notice notice notice-error">
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
		<?php esc_html_e( 'Active skin is missing!', 'lione' ); ?>
	</h3>
	<div class="lione_notice_text">
		<p>
			<?php
			// Translators: Add a current skin name to the message
			echo wp_kses_data( sprintf( __( "Your active skin <b>'%s'</b> is missing. Usually this happens when the theme is updated directly through the server or FTP.", 'lione' ), ucfirst( $lione_active_skin ) ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "Please use only <b>'ThemeREX Updater v.1.6.0+'</b> plugin for your future updates.", 'lione' ) );
			?>
		</p>
		<p>
			<?php
			echo wp_kses_data( __( "But no worries! You can re-download the skin via 'Skins Manager' ( Theme Panel - Theme Dashboard - Skins ).", 'lione' ) );
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
