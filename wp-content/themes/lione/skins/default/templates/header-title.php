<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package LIONE
 * @since LIONE 1.0
 */

// Page (category, tag, archive, author) title

if ( lione_need_page_title() ) {
	lione_sc_layouts_showed( 'title', true );
	lione_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								lione_show_post_meta(
									apply_filters(
										'lione_filter_post_meta_args', array(
											'components' => join( ',', lione_array_get_keys_by_value( lione_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', lione_array_get_keys_by_value( lione_get_theme_option( 'counters' ) ) ),
											'seo'        => lione_is_on( lione_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$lione_blog_title           = lione_get_blog_title();
							$lione_blog_title_text      = '';
							$lione_blog_title_class     = '';
							$lione_blog_title_link      = '';
							$lione_blog_title_link_text = '';
							if ( is_array( $lione_blog_title ) ) {
								$lione_blog_title_text      = $lione_blog_title['text'];
								$lione_blog_title_class     = ! empty( $lione_blog_title['class'] ) ? ' ' . $lione_blog_title['class'] : '';
								$lione_blog_title_link      = ! empty( $lione_blog_title['link'] ) ? $lione_blog_title['link'] : '';
								$lione_blog_title_link_text = ! empty( $lione_blog_title['link_text'] ) ? $lione_blog_title['link_text'] : '';
							} else {
								$lione_blog_title_text = $lione_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $lione_blog_title_class ); ?>">
								<?php
								$lione_top_icon = lione_get_term_image_small();
								if ( ! empty( $lione_top_icon ) ) {
									$lione_attr = lione_getimagesize( $lione_top_icon );
									?>
									<img src="<?php echo esc_url( $lione_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'lione' ); ?>"
										<?php
										if ( ! empty( $lione_attr[3] ) ) {
											lione_show_layout( $lione_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $lione_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $lione_blog_title_link ) && ! empty( $lione_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $lione_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $lione_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'lione_action_breadcrumbs' );
						$lione_breadcrumbs = ob_get_contents();
						ob_end_clean();
						lione_show_layout( $lione_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
