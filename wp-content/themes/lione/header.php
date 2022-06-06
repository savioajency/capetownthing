<?php
/**
 * The Header: Logo and main menu
 *
 * @package LIONE
 * @since LIONE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( lione_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'lione_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'lione_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('lione_action_body_wrap_attributes'); ?>>

		<?php do_action( 'lione_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'lione_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('lione_action_page_wrap_attributes'); ?>>

			<?php do_action( 'lione_action_page_wrap_start' ); ?>

			<?php
			$lione_full_post_loading = ( lione_is_singular( 'post' ) || lione_is_singular( 'attachment' ) ) && lione_get_value_gp( 'action' ) == 'full_post_loading';
			$lione_prev_post_loading = ( lione_is_singular( 'post' ) || lione_is_singular( 'attachment' ) ) && lione_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $lione_full_post_loading && ! $lione_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="lione_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'lione' ); ?></a>
				<?php if ( lione_sidebar_present() ) { ?>
				<a class="lione_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'lione' ); ?></a>
				<?php } ?>
				<a class="lione_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'lione' ); ?></a>

				<?php
				do_action( 'lione_action_before_header' );

				// Header
				$lione_header_type = lione_get_theme_option( 'header_type' );
				if ( 'custom' == $lione_header_type && ! lione_is_layouts_available() ) {
					$lione_header_type = 'default';
				}
				get_template_part( apply_filters( 'lione_filter_get_template_part', "templates/header-" . sanitize_file_name( $lione_header_type ) ) );

				// Side menu
				if ( in_array( lione_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'lione_action_after_header' );

			}
			?>

			<?php do_action( 'lione_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( lione_is_off( lione_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $lione_header_type ) ) {
						$lione_header_type = lione_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $lione_header_type && lione_is_layouts_available() ) {
						$lione_header_id = lione_get_custom_header_id();
						if ( $lione_header_id > 0 ) {
							$lione_header_meta = lione_get_custom_layout_meta( $lione_header_id );
							if ( ! empty( $lione_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$lione_footer_type = lione_get_theme_option( 'footer_type' );
					if ( 'custom' == $lione_footer_type && lione_is_layouts_available() ) {
						$lione_footer_id = lione_get_custom_footer_id();
						if ( $lione_footer_id ) {
							$lione_footer_meta = lione_get_custom_layout_meta( $lione_footer_id );
							if ( ! empty( $lione_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'lione_action_page_content_wrap_class', $lione_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'lione_filter_is_prev_post_loading', $lione_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( lione_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'lione_action_page_content_wrap_data', $lione_prev_post_loading );
			?>>
				<?php
				do_action( 'lione_action_page_content_wrap', $lione_full_post_loading || $lione_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'lione_filter_single_post_header', lione_is_singular( 'post' ) || lione_is_singular( 'attachment' ) ) ) {
					if ( $lione_prev_post_loading ) {
						if ( lione_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'lione_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$lione_path = apply_filters( 'lione_filter_get_template_part', 'templates/single-styles/' . lione_get_theme_option( 'single_style' ) );
					if ( lione_get_file_dir( $lione_path . '.php' ) != '' ) {
						get_template_part( $lione_path );
					}
				}

				// Widgets area above page
				$lione_body_style   = lione_get_theme_option( 'body_style' );
				$lione_widgets_name = lione_get_theme_option( 'widgets_above_page' );
				$lione_show_widgets = ! lione_is_off( $lione_widgets_name ) && is_active_sidebar( $lione_widgets_name );
				if ( $lione_show_widgets ) {
					if ( 'fullscreen' != $lione_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					lione_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $lione_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'lione_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $lione_body_style ? '_fullscreen' : ''; ?>">

					<div class="content">
						<?php
						do_action( 'lione_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="lione_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( lione_is_singular( 'post' ) || lione_is_singular( 'attachment' ) )
							&& $lione_prev_post_loading 
							&& lione_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'lione_action_between_posts' );
						}

						// Widgets area above content
						lione_create_widgets_area( 'widgets_above_content' );

						do_action( 'lione_action_page_content_start_text' );
