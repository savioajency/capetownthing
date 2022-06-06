<div class="front_page_section front_page_section_contacts<?php
	$lione_scheme = lione_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $lione_scheme ) && ! lione_is_inherit( $lione_scheme ) ) {
		echo ' scheme_' . esc_attr( $lione_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( lione_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( lione_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$lione_css      = '';
		$lione_bg_image = lione_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $lione_bg_image ) ) {
			$lione_css .= 'background-image: url(' . esc_url( lione_get_attachment_url( $lione_bg_image ) ) . ');';
		}
		if ( ! empty( $lione_css ) ) {
			echo ' style="' . esc_attr( $lione_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$lione_anchor_icon = lione_get_theme_option( 'front_page_contacts_anchor_icon' );
	$lione_anchor_text = lione_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $lione_anchor_icon ) || ! empty( $lione_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $lione_anchor_icon ) ? ' icon="' . esc_attr( $lione_anchor_icon ) . '"' : '' )
									. ( ! empty( $lione_anchor_text ) ? ' title="' . esc_attr( $lione_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( lione_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' lione-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$lione_css      = '';
			$lione_bg_mask  = lione_get_theme_option( 'front_page_contacts_bg_mask' );
			$lione_bg_color_type = lione_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $lione_bg_color_type ) {
				$lione_bg_color = lione_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $lione_bg_color_type ) {
				$lione_bg_color = lione_get_scheme_color( 'bg_color', $lione_scheme );
			} else {
				$lione_bg_color = '';
			}
			if ( ! empty( $lione_bg_color ) && $lione_bg_mask > 0 ) {
				$lione_css .= 'background-color: ' . esc_attr(
					1 == $lione_bg_mask ? $lione_bg_color : lione_hex2rgba( $lione_bg_color, $lione_bg_mask )
				) . ';';
			}
			if ( ! empty( $lione_css ) ) {
				echo ' style="' . esc_attr( $lione_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$lione_caption     = lione_get_theme_option( 'front_page_contacts_caption' );
			$lione_description = lione_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $lione_caption ) || ! empty( $lione_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $lione_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $lione_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $lione_caption, 'lione_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $lione_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $lione_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $lione_description ), 'lione_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$lione_content = lione_get_theme_option( 'front_page_contacts_content' );
			$lione_layout  = lione_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $lione_layout && ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $lione_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $lione_content, 'lione_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $lione_layout && ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$lione_sc = lione_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $lione_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $lione_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					lione_show_layout( do_shortcode( $lione_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $lione_layout && ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
