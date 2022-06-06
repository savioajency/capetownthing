<?php
/**
 * The template to display default site footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$lione_footer_scheme = lione_get_theme_option( 'footer_scheme' );
if ( ! empty( $lione_footer_scheme ) && ! lione_is_inherit( $lione_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $lione_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'lione_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
