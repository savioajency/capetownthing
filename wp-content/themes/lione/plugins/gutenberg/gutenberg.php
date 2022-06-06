<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'lione_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'lione_gutenberg_theme_setup9', 9 );
	function lione_gutenberg_theme_setup9() {

		// Add wide and full blocks support
		add_theme_support( 'align-wide' );

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if ( is_admin() ) {
			if ( lione_exists_gutenberg() && lione_gutenberg_is_preview() ) {
				if ( ! lione_get_theme_setting( 'gutenberg_add_context' ) ) {
					if ( ! lione_exists_trx_addons() ) {
						// Attention! This place need to use 'trx_addons_filter' instead 'lione_filter'
						add_editor_style( apply_filters( 'trx_addons_filter_add_editor_style', array(), 'gutenberg' ) );
					}
				}
			} else {
				add_editor_style( apply_filters( 'lione_filter_add_editor_style', array(
					lione_get_file_url( 'css/font-icons/css/fontello.css' ),
					lione_get_file_url( 'css/editor-style.css' )
					), 'editor' )
				);
			}
		}

		if ( lione_exists_gutenberg() ) {
			add_action( 'wp_enqueue_scripts', 'lione_gutenberg_frontend_scripts', 1100 );
			add_action( 'wp_enqueue_scripts', 'lione_gutenberg_responsive_styles', 2000 );
			add_filter( 'lione_filter_merge_styles', 'lione_gutenberg_merge_styles' );
			add_filter( 'lione_filter_merge_styles_responsive', 'lione_gutenberg_merge_styles_responsive' );
		}
		add_action( 'enqueue_block_editor_assets', 'lione_gutenberg_editor_scripts' );
		add_filter( 'lione_filter_localize_script_admin',	'lione_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'lione_gutenberg_add_editor_colors' );
		if ( is_admin() ) {
			add_filter( 'lione_filter_tgmpa_required_plugins', 'lione_gutenberg_tgmpa_required_plugins' );
			add_filter( 'lione_filter_theme_plugins', 'lione_gutenberg_theme_plugins' );
		}
	}
}

// Add theme's icons styles to the Gutenberg editor
if ( ! function_exists( 'lione_gutenberg_add_editor_style_icons' ) ) {
	add_filter( 'trx_addons_filter_add_editor_style', 'lione_gutenberg_add_editor_style_icons', 10 );
	function lione_gutenberg_add_editor_style_icons( $styles ) {
		$lione_url = lione_get_file_url( 'css/font-icons/css/fontello.css' );
		if ( '' != $lione_url ) {
			$styles[] = $lione_url;
		}
		return $styles;
	}
}

// Add required styles to the Gutenberg editor
if ( ! function_exists( 'lione_gutenberg_add_editor_style' ) ) {
	add_filter( 'trx_addons_filter_add_editor_style', 'lione_gutenberg_add_editor_style', 1100 );
	function lione_gutenberg_add_editor_style( $styles ) {
		$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' );
		if ( '' != $lione_url ) {
			$styles[] = $lione_url;
		}
		return $styles;
	}
}

// Add required styles to the Gutenberg editor
if ( ! function_exists( 'lione_gutenberg_add_editor_style_responsive' ) ) {
	add_filter( 'trx_addons_filter_add_editor_style', 'lione_gutenberg_add_editor_style_responsive', 2000 );
	function lione_gutenberg_add_editor_style_responsive( $styles ) {
		$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg-preview-responsive.css' );
		if ( '' != $lione_url ) {
			$styles[] = $lione_url;
		}
		return $styles;
	}
}

// Remove main-theme and child-theme urls from the editor style paths
if ( ! function_exists( 'lione_gutenberg_add_editor_style_remove_theme_url' ) ) {
	add_filter( 'trx_addons_filter_add_editor_style', 'lione_gutenberg_add_editor_style_remove_theme_url', 9999 );
	function lione_gutenberg_add_editor_style_remove_theme_url( $styles ) {
		if ( is_array( $styles ) ) {
			$template_uri   = trailingslashit( get_template_directory_uri() );
			$stylesheet_uri = trailingslashit( get_stylesheet_directory_uri() );
			$plugins_uri    = trailingslashit( defined( 'WP_PLUGIN_URL' ) ? WP_PLUGIN_URL : plugins_url() );
			foreach( $styles as $k => $v ) {
				$styles[ $k ] = str_replace(
									array(
										$template_uri,
										$stylesheet_uri,
										$plugins_uri
									),
									array(
										'',
										'',
										'../'          // up to the folder 'themes'
										. '../'        // up to the folder 'wp-content'
										. 'plugins/'   // open the folder 'plugins'
									),
									$v
								);
			}
		}
		return $styles;
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'lione_gutenberg_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('lione_filter_tgmpa_required_plugins',	'lione_gutenberg_tgmpa_required_plugins');
	function lione_gutenberg_tgmpa_required_plugins( $list = array() ) {
		if ( lione_storage_isset( 'required_plugins', 'gutenberg' ) ) {
			if ( lione_storage_get_array( 'required_plugins', 'gutenberg', 'install' ) !== false && version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
				$list[] = array(
					'name'     => lione_storage_get_array( 'required_plugins', 'gutenberg', 'title' ),
					'slug'     => 'gutenberg',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'lione_gutenberg_theme_plugins' ) ) {
	//Handler of the add_filter( 'lione_filter_theme_plugins', 'lione_gutenberg_theme_plugins' );
	function lione_gutenberg_theme_plugins( $list = array() ) {
		$list = lione_add_group_and_logo_to_slave( $list, 'gutenberg', 'coblocks' );
		$list = lione_add_group_and_logo_to_slave( $list, 'gutenberg', 'kadence-blocks' );
		return $list;
	}
}


// Check if Gutenberg is installed and activated
if ( ! function_exists( 'lione_exists_gutenberg' ) ) {
	function lione_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'lione_gutenberg_is_preview' ) ) {
	function lione_gutenberg_is_preview() {
		return lione_exists_gutenberg() 
				&& (
					lione_gutenberg_is_block_render_action()
					||
					lione_is_post_edit()
					||
					lione_gutenberg_is_widgets_block_editor()
					||
					lione_gutenberg_is_site_editor()
					);
	}
}

// Return true if current mode is "Full Site Editor"
if ( ! function_exists( 'lione_gutenberg_is_site_editor' ) ) {
	function lione_gutenberg_is_site_editor() {
		return is_admin()
				&& lione_exists_gutenberg() 
				&& version_compare( get_bloginfo( 'version' ), '5.9', '>=' )
				&& lione_check_url( 'site-editor.php' )
				&& lione_gutenberg_is_fse_theme();
	}
}

// Return true if current mode is "Widgets Block Editor" (a new widgets panel with Gutenberg support)
if ( ! function_exists( 'lione_gutenberg_is_widgets_block_editor' ) ) {
	function lione_gutenberg_is_widgets_block_editor() {
		return is_admin()
				&& lione_exists_gutenberg() 
				&& version_compare( get_bloginfo( 'version' ), '5.8', '>=' )
				&& lione_check_url( 'widgets.php' )
				&& function_exists( 'wp_use_widgets_block_editor' )
				&& wp_use_widgets_block_editor();
	}
}

// Return true if current mode is "Block render"
if ( ! function_exists( 'lione_gutenberg_is_block_render_action' ) ) {
	function lione_gutenberg_is_block_render_action() {
		return lione_exists_gutenberg() 
				&& lione_check_url( 'block-renderer' ) && ! empty( $_GET['context'] ) && 'edit' == $_GET['context'];
	}
}

// Return true if content built with "Gutenberg"
if ( ! function_exists( 'lione_gutenberg_is_content_built' ) ) {
	function lione_gutenberg_is_content_built($content) {
		return lione_exists_gutenberg() 
				&& has_blocks( $content );	// This condition is equval to: strpos($content, '<!-- wp:') !== false;
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'lione_gutenberg_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'lione_gutenberg_frontend_scripts', 1100 );
	function lione_gutenberg_frontend_scripts() {
		if ( lione_is_on( lione_get_theme_option( 'debug_mode' ) ) ) {
			// Theme-specific styles
			$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg-general.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-gutenberg-general', $lione_url, array(), null );
			}
			// Skin-specific styles
			$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-gutenberg', $lione_url, array(), null );
			}
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'lione_gutenberg_responsive_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'lione_gutenberg_responsive_styles', 2000 );
	function lione_gutenberg_responsive_styles() {
		if ( lione_is_on( lione_get_theme_option( 'debug_mode' ) ) ) {
			// Theme-specific styles
			$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg-general-responsive.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-gutenberg-general-responsive', $lione_url, array(), null, lione_media_for_load_css_responsive( 'gutenberg-general' ) );
			}
			// Skin-specific styles
			$lione_url = lione_get_file_url( 'plugins/gutenberg/gutenberg-responsive.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-gutenberg-responsive', $lione_url, array(), null, lione_media_for_load_css_responsive( 'gutenberg' ) );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'lione_gutenberg_merge_styles' ) ) {
	//Handler of the add_filter('lione_filter_merge_styles', 'lione_gutenberg_merge_styles');
	function lione_gutenberg_merge_styles( $list ) {
		$list[ 'plugins/gutenberg/gutenberg-general.css' ] = true;
		$list[ 'plugins/gutenberg/gutenberg.css' ] = true;
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'lione_gutenberg_merge_styles_responsive' ) ) {
	//Handler of the add_filter('lione_filter_merge_styles_responsive', 'lione_gutenberg_merge_styles_responsive');
	function lione_gutenberg_merge_styles_responsive( $list ) {
		$list[ 'plugins/gutenberg/gutenberg-general-responsive.css' ] = true;
		$list[ 'plugins/gutenberg/gutenberg-responsive.css' ] = true;
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'lione_gutenberg_editor_scripts' ) ) {
	//Handler of the add_action( 'enqueue_block_editor_assets', 'lione_gutenberg_editor_scripts');
	function lione_gutenberg_editor_scripts() {
		lione_admin_scripts(true);
		lione_admin_localize_scripts();
		// Editor styles
		wp_enqueue_style( 'lione-gutenberg-editor', lione_get_file_url( 'plugins/gutenberg/gutenberg-editor.css' ), array(), null );
		// Block styles
		if ( lione_get_theme_setting( 'gutenberg_add_context' ) ) {
			wp_enqueue_style( 'lione-gutenberg-preview', lione_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ), array(), null );
			wp_enqueue_style( 'lione-gutenberg-preview-responsive', lione_get_file_url( 'plugins/gutenberg/gutenberg-preview-responsive.css' ), array(), null );
		}
		// Load merged scripts ?????
		wp_enqueue_script( 'lione-main', lione_get_file_url( 'js/__scripts-full.js' ), apply_filters( 'lione_filter_script_deps', array( 'jquery' ) ), null, true );
		// Editor scripts
		wp_enqueue_script( 'lione-gutenberg-preview', lione_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );
	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'lione_gutenberg_localize_script' ) ) {
	//Handler of the add_filter( 'lione_filter_localize_script_admin',	'lione_gutenberg_localize_script');
	function lione_gutenberg_localize_script( $arr ) {
		// Color scheme
		$arr['color_scheme'] = lione_get_theme_option( 'color_scheme' );
		// Sidebar position on the single posts
		$arr['sidebar_position'] = 'inherit';
		$arr['expand_content']   = 'inherit';
		$post_type               = 'post';
		$post_id                 = lione_get_value_gpc( 'post' );
		if ( lione_gutenberg_is_preview() )  {
			if ( ! empty( $post_id ) ) {
				$post_type = lione_get_edited_post_type();
				$meta = get_post_meta( $post_id, 'lione_options', true );
				if ( 'page' != $post_type && ! empty( $meta['sidebar_position_single'] ) ) {
					$arr['sidebar_position'] = $meta['sidebar_position_single'];
				} elseif ( 'page' == $post_type && ! empty( $meta['sidebar_position'] ) ) {
					$arr['sidebar_position'] = $meta['sidebar_position'];
				}
				if ( 'page' != $post_type && ! empty( $meta['expand_content_single'] ) ) {
					$arr['expand_content'] = $meta['expand_content_single'];
				} elseif ( 'page' == $post_type && ! empty( $meta['expand_content'] ) ) {
					$arr['expand_content'] = $meta['expand_content'];
				}
			} else {
				$post_type = lione_get_value_gpc( 'post_type' );
				if ( empty( $post_type ) ) {
					$post_type = 'post';
				}
			}
		}
		$post_slug = str_replace( 'cpt_', '', $post_type );
		if ( 'inherit' == $arr['sidebar_position'] ) {
			if ( 'post' == $post_type ) {
				$arr['sidebar_position'] = lione_get_theme_option( 'sidebar_position_single' );
				if ( 'inherit' == $arr['sidebar_position'] ) {
					$arr['sidebar_position'] = lione_get_theme_option( 'sidebar_position_blog' );
				}
			} else if ( 'page' != $post_type && lione_check_theme_option( 'sidebar_position_single_' . sanitize_title( $post_slug ) ) ) {
				$arr['sidebar_position'] = lione_get_theme_option( 'sidebar_position_single_' . sanitize_title( $post_slug ) );
				if ( 'inherit' == $arr['sidebar_position'] && lione_check_theme_option( 'sidebar_position_' . sanitize_title( $post_slug ) ) ) {
					$arr['sidebar_position'] = lione_get_theme_option( 'sidebar_position_' . sanitize_title( $post_slug ) );
				}
			}
			if ( 'inherit' == $arr['sidebar_position'] ) {
				$arr['sidebar_position'] = lione_get_theme_option( 'sidebar_position' );
			}
		}
		if ( 'inherit' == $arr['expand_content'] ) {
			if ( 'post' == $post_type ) {
				$arr['expand_content'] = lione_get_theme_option( 'expand_content_single' );
				if ( 'inherit' == $arr['expand_content'] ) {
					$arr['expand_content'] = lione_get_theme_option( 'expand_content_blog' );
				}
			} else if ( 'page' != $post_type && lione_check_theme_option( 'expand_content_single_' . sanitize_title( $post_slug ) ) ) {
				$arr['expand_content'] = lione_get_theme_option( 'expand_content_single_' . sanitize_title( $post_slug ) );
				if ( 'inherit' == $arr['expand_content'] && lione_check_theme_option( 'expand_content_' . sanitize_title( $post_slug ) ) ) {
					$arr['expand_content'] = lione_get_theme_option( 'expand_content_' . sanitize_title( $post_slug ) );
				}
			}
			if ( 'inherit' == $arr['expand_content'] ) {
				$arr['expand_content'] = lione_get_theme_option( 'expand_content' );
			}
		}
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-preview.css
if ( ! function_exists( 'lione_gutenberg_save_css' ) ) {
	add_action( 'lione_action_save_options', 'lione_gutenberg_save_css', 30 );
	add_action( 'trx_addons_action_save_options', 'lione_gutenberg_save_css', 30 );
	function lione_gutenberg_save_css() {

		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'lione' )
				. "\n----------------------------------------------------------------------- */\n";

		$add_context = array(
							'context'      => '.edit-post-visual-editor ',
							'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
							);

		// Get main styles
		//----------------------------------------------
		$css = apply_filters( 'lione_filter_gutenberg_get_styles', lione_fgc( lione_get_file_dir( 'style.css' ) ) );
		// Append single post styles
		if ( apply_filters( 'lione_filters_separate_single_styles', false ) ) {
			$css .= lione_fgc( lione_get_file_dir( 'css/__single.css' ) );
		}
		// Append supported plugins styles
		$css .= lione_fgc( lione_get_file_dir( 'css/__plugins-full.css' ) );
		// Append theme-vars styles
		$css .= lione_customizer_get_css();
		// Add context class to each selector
		if ( lione_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css = trx_addons_css_add_context( $css, $add_context );
		} else {
			$css = apply_filters( 'lione_filter_prepare_css', $css );
		}

		// Get responsive styles
		//-----------------------------------------------
		$css_responsive = apply_filters( 'lione_filter_gutenberg_get_styles_responsive',
								lione_fgc( lione_get_file_dir( 'css/__responsive-full.css' ) )
								. ( apply_filters( 'lione_filters_separate_single_styles', false )
									? lione_fgc( lione_get_file_dir( 'css/__single-responsive.css' ) )
									: ''
									)
								);
		// Add context class to each selector
		if ( lione_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css_responsive = trx_addons_css_add_context( $css_responsive, $add_context );
		} else {
			$css_responsive = apply_filters( 'lione_filter_prepare_css', $css_responsive );
		}

		// Save styles to separate files
		//-----------------------------------------------

		// Save responsive styles
		$preview = lione_get_file_dir( 'plugins/gutenberg/gutenberg-preview-responsive.css' );
		if ( $preview ) {
			lione_fpc( $preview, $msg . $css_responsive );
			$css_responsive = '';
		}
		// Save main styles (and append responsive if its not saved to the separate file)
		lione_fpc( lione_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css . $css_responsive );
	}
}


// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'lione_gutenberg_add_editor_colors' ) ) {
	//Hamdler of the add_action( 'after_setup_theme', 'lione_gutenberg_add_editor_colors' );
	function lione_gutenberg_add_editor_colors() {
		$scheme = lione_get_scheme_colors();
		$groups = lione_storage_get( 'scheme_color_groups' );
		$names  = lione_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? ( 'text' == $n ? 'text_color' : $n ) : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			// Add only one group of colors
			// Delete next condition (or add false && to them) to add all groups
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}

// Add plugin-specific colors and fonts to the custom CSS
if ( lione_exists_gutenberg() ) {
	require_once lione_get_file_dir( 'plugins/gutenberg/gutenberg-style.php' );
	require_once lione_get_file_dir( 'plugins/gutenberg/gutenberg-fse.php' );
}
