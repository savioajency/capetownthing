<?php
/**
 * The template to display Admin notices
 *
 * @package LIONE
 * @since LIONE 1.0.1
 */

$lione_theme_slug = get_option( 'template' );
$lione_theme_obj  = wp_get_theme( $lione_theme_slug );
?>
<div class="lione_admin_notice lione_welcome_notice notice notice-info is-dismissible" data-notice="admin">
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
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'lione' ),
				$lione_theme_obj->get( 'Name' ) . ( LIONE_THEME_FREE ? ' ' . __( 'Free', 'lione' ) : '' ),
				$lione_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="lione_notice_text">
		<p class="lione_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $lione_theme_obj->description ) );
			?>
		</p>
		<p class="lione_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'lione' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="lione_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=lione_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'lione' );
			?>
		</a>
	</div>
</div>
