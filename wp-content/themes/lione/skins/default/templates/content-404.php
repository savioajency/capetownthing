<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<p class="page_title"><?php esc_html_e( '404', 'lione' ); ?></p>
		<div class="page_info">
			<h2 class="page_subtitle"><?php esc_html_e( 'Page Not Found', 'lione' ); ?></h2>
			<p class="page_description"><?php echo wp_kses( __( "We're sorry, but <br>something went wrong.", 'lione' ), 'lione_kses_content' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="go_home theme_button"><?php esc_html_e( 'Go Home', 'lione' ); ?></a>
		</div>

		<?php
		// SVG
		$svg_bg_1 = lione_get_svg_from_file( lione_get_file_dir( 'images/svg_bg_1.svg' ) );
		if ( ! empty( $svg_bg_1 ) ) {
            $svg_bg = '<span class="svg-1">' . $svg_bg_1 . '</span>' .
                      '<span class="svg-2">' . $svg_bg_1 . '</span>' .
                      '<span class="svg-3">' . $svg_bg_1 . '</span>' .
                      '<span class="svg-4">' . $svg_bg_1 . '</span>' .
                      '<span class="svg-5">' . $svg_bg_1 . '</span>' .
                      '<span class="svg-6">' . $svg_bg_1 . '</span>';
		    ?>
            <div class="all-svg">
                <?php lione_show_layout( $svg_bg ); ?>
            </div>
		<?php } ?>
	</div>
</article>