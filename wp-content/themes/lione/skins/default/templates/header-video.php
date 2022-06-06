<?php
/**
 * The template to display the background video in the header
 *
 * @package LIONE
 * @since LIONE 1.0.14
 */
$lione_header_video = lione_get_header_video();
$lione_embed_video  = '';
if ( ! empty( $lione_header_video ) && ! lione_is_from_uploads( $lione_header_video ) ) {
	if ( lione_is_youtube_url( $lione_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $lione_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php lione_show_layout( lione_get_embed_video( $lione_header_video ) ); ?></div>
		<?php
	}
}
