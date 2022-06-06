<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'lione_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'lione_essential_grid_theme_setup9', 9 );
	function lione_essential_grid_theme_setup9() {
		if ( lione_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'lione_essential_grid_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'lione_essential_grid_frontend_scripts', 10, 1 );
			add_filter( 'lione_filter_merge_styles', 'lione_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'lione_filter_tgmpa_required_plugins', 'lione_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'lione_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('lione_filter_tgmpa_required_plugins',	'lione_essential_grid_tgmpa_required_plugins');
	function lione_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( lione_storage_isset( 'required_plugins', 'essential-grid' ) && lione_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && lione_is_theme_activated() ) {
			$path = lione_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || lione_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => lione_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'version'  => '2.2.4.2',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'lione_exists_essential_grid' ) ) {
	function lione_exists_essential_grid() {
		return defined( 'EG_PLUGIN_PATH' ) || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'lione_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'lione_essential_grid_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_essential_grid', 'lione_essential_grid_frontend_scripts', 10, 1 );
	function lione_essential_grid_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && lione_need_frontend_scripts( 'essential_grid' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$lione_url = lione_get_file_url( 'plugins/essential-grid/essential-grid.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-essential-grid', $lione_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'lione_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('lione_filter_merge_styles', 'lione_essential_grid_merge_styles');
	function lione_essential_grid_merge_styles( $list ) {
		$list[ 'plugins/essential-grid/essential-grid.css' ] = false;
		return $list;
	}
}
