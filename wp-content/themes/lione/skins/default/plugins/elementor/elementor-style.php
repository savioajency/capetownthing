<?php
// Add plugin-specific fonts to the custom CSS
if ( ! function_exists( 'lione_elm_get_css' ) ) {
    add_filter( 'lione_filter_get_css', 'lione_elm_get_css', 10, 2 );
    function lione_elm_get_css( $css, $args ) {

        if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
            $fonts         = $args['fonts'];
            $css['fonts'] .= <<<CSS
.elementor-widget-progress .elementor-title,
.elementor-widget-progress .elementor-progress-percentage,
.elementor-widget-toggle .elementor-toggle-title,       
.elementor-widget-tabs .elementor-tab-title,         
.elementor-widget-counter .elementor-counter-number-wrapper {
	{$fonts['h5_font-family']}
}
.elementor-widget-icon-box .elementor-widget-container .elementor-icon-box-title small {
    {$fonts['p_font-family']}
}

CSS;
        }

        return $css;
    }
}


// Add theme-specific CSS-animations
if ( ! function_exists( 'lione_elm_add_theme_animations' ) ) {
	add_filter( 'elementor/controls/animations/additional_animations', 'lione_elm_add_theme_animations' );
	function lione_elm_add_theme_animations( $animations ) {
		/* To add a theme-specific animations to the list:
			1) Merge to the array 'animations': array(
													esc_html__( 'Theme Specific', 'lione' ) => array(
														'ta_custom_1' => esc_html__( 'Custom 1', 'lione' )
													)
												)
			2) Add a CSS rules for the class '.ta_custom_1' to create a custom entrance animation
		*/
		$animations = array_merge(
						$animations,
						array(
							esc_html__( 'Theme Specific', 'lione' ) => array(
									'ta_under_strips' => esc_html__( 'Under the strips', 'lione' ),
									'lione-fadeinup' => esc_html__( 'Lione - Fade In Up', 'lione' ),
									'lione-fadeinright' => esc_html__( 'Lione - Fade In Right', 'lione' ),
									'lione-fadeinleft' => esc_html__( 'Lione - Fade In Left', 'lione' ),
									'lione-fadeindown' => esc_html__( 'Lione - Fade In Down', 'lione' ),
									'lione-fadein' => esc_html__( 'Lione - Fade In', 'lione' ),
									'lione-infinite-rotate' => esc_html__( 'Lione - Infinite Rotate', 'lione' ),
								)
							)
						);

		return $animations;
	}
}
