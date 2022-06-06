<?php
// Add theme-specific fonts, vars and colors to the custom CSS
if ( ! function_exists( 'lione_add_css_vars' ) ) {
	add_filter( 'lione_filter_get_css', 'lione_add_css_vars', 1, 2 );
	function lione_add_css_vars( $css, $args ) {

		// Add fonts settings to css variables
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts = $args['fonts'];
			if ( is_array( $fonts ) && count( $fonts ) > 0 ) {
				$tmp = ":root {\n";
				foreach( $fonts as $tag => $font ) {
					if ( is_array( $font ) ) {
						$tmp .= "--theme-font-{$tag}_font-family: " . ( ! empty( $font['font-family'] ) && ! lione_is_inherit( $font['font-family'] )
																	? lione_prepare_css_value( $font['font-family'] )
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_font-size: " . ( ! empty( $font['font-size'] ) && ! lione_is_inherit( $font['font-size'] )
																	? lione_prepare_css_value( $font['font-size'] )
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_line-height: " . ( ! empty( $font['line-height'] ) && ! lione_is_inherit( $font['line-height'] )
																	? $font['line-height']
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_font-weight: " . ( ! empty( $font['font-weight'] ) && ! lione_is_inherit( $font['font-weight'] )
																	? $font['font-weight']
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_font-style: " . ( ! empty( $font['font-style'] ) && ! lione_is_inherit( $font['font-style'] )
																	? $font['font-style']
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_text-decoration: " . ( ! empty( $font['text-decoration'] ) && ! lione_is_inherit( $font['text-decoration'] )
																	? $font['text-decoration']
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_text-transform: " . ( ! empty( $font['text-transform'] ) && ! lione_is_inherit( $font['text-transform'] )
																	? $font['text-transform']
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_letter-spacing: " . ( ! empty( $font['letter-spacing'] ) && ! lione_is_inherit( $font['letter-spacing'] )
																	? lione_prepare_css_value( $font['letter-spacing'] )
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_margin-top: " . ( ! empty( $font['margin-top'] ) && ! lione_is_inherit( $font['margin-top'] )
																	? lione_prepare_css_value( $font['margin-top'] )
																	: 'inherit'
																) . ";\n"
								. "--theme-font-{$tag}_margin-bottom: " . ( ! empty( $font['margin-bottom'] ) && ! lione_is_inherit( $font['margin-bottom'] )
																	? lione_prepare_css_value( $font['margin-bottom'] )
																	: 'inherit'
																) . ";\n";
					}
				}
				$css['fonts'] = $tmp . "\n}\n" . $css['fonts'];
			}
		}

		// Add theme-specific values to css variables
		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars = $args['vars'];
			if ( is_array( $vars ) && count( $vars ) > 0 ) {
				$tmp = ":root {\n";
				// Remove calculated values from css variables
				$exclude = apply_filters( 'lione_filter_exclude_theme_vars', array( 'sidebar_width', 'sidebar_gap' ) );
				// Add rest values to css variables
				foreach ( $vars as $var => $value ) {
					if ( ! in_array( $var, $exclude ) ) {
						$tmp .= "--theme-var-{$var}: " . ( empty( $value ) ? 0 : $value ) . ";\n";
					}
				}
				$css['vars'] = $tmp . "\n}\n" . $css['vars'];
			}
		}

		// Add theme-specific colors to css variables
		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors = $args['colors'];
			if ( is_array( $colors ) && count( $colors ) > 0 ) {
				$tmp = ".scheme_{$args['scheme']}, body.scheme_{$args['scheme']} {\n";
				foreach ( $colors as $color => $value ) {
					$tmp .= "--theme-color-{$color}: {$value};\n";
				}
				$css['colors'] = $tmp . "\n}\n" . $css['colors'];
			}
		}

		return $css;
	}
}

