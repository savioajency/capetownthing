<?php
/**
 * The template to display the attachment
 *
 * @package LIONE
 * @since LIONE 1.0
 */


get_header();

while ( have_posts() ) {
	the_post();

	// Display post's content
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/content', 'single-' . lione_get_theme_option( 'single_style' ) ), 'single-' . lione_get_theme_option( 'single_style' ) );

	// Parent post navigation.
	$lione_posts_navigation = lione_get_theme_option( 'posts_navigation' );
	if ( 'links' == $lione_posts_navigation ) {
		?>
		<div class="nav-links-single<?php
			if ( ! lione_is_off( lione_get_theme_option( 'posts_navigation_fixed' ) ) ) {
				echo ' nav-links-fixed fixed';
			}
		?>">
			<?php
			the_post_navigation( apply_filters( 'lione_filter_post_navigation_args', array(
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Published in', 'lione' ) . '</span> '
						. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'lione' ) . '</span> '
						. '<h5 class="post-title">%title</h5>'
						. '<span class="post_date">%date</span>',
			), 'image' ) );
			?>
		</div>
		<?php
	}

	// Comments
	do_action( 'lione_action_before_comments' );
	comments_template();
	do_action( 'lione_action_after_comments' );
}

get_footer();
