<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package LIONE
 * @since LIONE 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$lione_copyright_scheme = lione_get_theme_option( 'copyright_scheme' );
if ( ! empty( $lione_copyright_scheme ) && ! lione_is_inherit( $lione_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $lione_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$lione_copyright = lione_get_theme_option( 'copyright' );
			if ( ! empty( $lione_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$lione_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $lione_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$lione_copyright = lione_prepare_macros( $lione_copyright );
				// Display copyright
				echo wp_kses( nl2br( $lione_copyright ), 'lione_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
