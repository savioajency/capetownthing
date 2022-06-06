<div class="front_page_section front_page_section_about<?php
	$lione_scheme = lione_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $lione_scheme ) && ! lione_is_inherit( $lione_scheme ) ) {
		echo ' scheme_' . esc_attr( $lione_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( lione_get_theme_option( 'front_page_about_paddings' ) );
	if ( lione_get_theme_option( 'front_page_about_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$lione_css      = '';
		$lione_bg_image = lione_get_theme_option( 'front_page_about_bg_image' );
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
	$lione_anchor_icon = lione_get_theme_option( 'front_page_about_anchor_icon' );
	$lione_anchor_text = lione_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $lione_anchor_icon ) || ! empty( $lione_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $lione_anchor_icon ) ? ' icon="' . esc_attr( $lione_anchor_icon ) . '"' : '' )
									. ( ! empty( $lione_anchor_text ) ? ' title="' . esc_attr( $lione_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( lione_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' lione-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$lione_css           = '';
			$lione_bg_mask       = lione_get_theme_option( 'front_page_about_bg_mask' );
			$lione_bg_color_type = lione_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $lione_bg_color_type ) {
				$lione_bg_color = lione_get_theme_option( 'front_page_about_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$lione_caption = lione_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $lione_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $lione_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $lione_caption, 'lione_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$lione_description = lione_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $lione_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $lione_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $lione_description ), 'lione_kses_content' ); ?></div>
				<?php
			}

			// Content
			$lione_content = lione_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $lione_content ) ? 'filled' : 'empty'; ?>">
					<?php
					$lione_page_content_mask = '%%CONTENT%%';
					if ( strpos( $lione_content, $lione_page_content_mask ) !== false ) {
						$lione_content = preg_replace(
							'/(\<p\>\s*)?' . $lione_page_content_mask . '(\s*\<\/p\>)/i',
							sprintf(
								'<div class="front_page_section_about_source">%s</div>',
								apply_filters( 'the_content', get_the_content() )
							),
							$lione_content
						);
					}
					lione_show_layout( $lione_content );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
