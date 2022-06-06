<div class="front_page_section front_page_section_googlemap<?php
	$lione_scheme = lione_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $lione_scheme ) && ! lione_is_inherit( $lione_scheme ) ) {
		echo ' scheme_' . esc_attr( $lione_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( lione_get_theme_option( 'front_page_googlemap_paddings' ) );
	if ( lione_get_theme_option( 'front_page_googlemap_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$lione_css      = '';
		$lione_bg_image = lione_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$lione_anchor_icon = lione_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$lione_anchor_text = lione_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $lione_anchor_icon ) || ! empty( $lione_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $lione_anchor_icon ) ? ' icon="' . esc_attr( $lione_anchor_icon ) . '"' : '' )
									. ( ! empty( $lione_anchor_text ) ? ' title="' . esc_attr( $lione_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
		<?php
		$lione_layout = lione_get_theme_option( 'front_page_googlemap_layout' );
		echo ' front_page_section_layout_' . esc_attr( $lione_layout );
		if ( lione_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
			echo ' lione-full-height sc_layouts_flex sc_layouts_columns_middle';
		}
		?>
		"
			<?php
			$lione_css      = '';
			$lione_bg_mask  = lione_get_theme_option( 'front_page_googlemap_bg_mask' );
			$lione_bg_color_type = lione_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $lione_bg_color_type ) {
				$lione_bg_color = lione_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
		if ( 'fullwidth' != $lione_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$lione_caption     = lione_get_theme_option( 'front_page_googlemap_caption' );
			$lione_description = lione_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $lione_caption ) || ! empty( $lione_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $lione_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $lione_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $lione_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $lione_caption, 'lione_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $lione_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $lione_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $lione_description ), 'lione_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $lione_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$lione_content = lione_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $lione_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $lione_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $lione_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $lione_content, 'lione_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $lione_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $lione_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
				<?php
				if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! lione_exists_trx_addons() ) {
						lione_customizer_need_trx_addons_message();
					} else {
						lione_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
					}
				}
				?>
			</div>
			<?php

			if ( 'columns' == $lione_layout && ( ! empty( $lione_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
