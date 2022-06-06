<?php
/**
 * The template to display the socials in the footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */


// Socials
if ( lione_is_on( lione_get_theme_option( 'socials_in_footer' ) ) ) {
	$lione_output = lione_get_socials_links();
	if ( '' != $lione_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php lione_show_layout( $lione_output ); ?>
			</div>
		</div>
		<?php
	}
}
