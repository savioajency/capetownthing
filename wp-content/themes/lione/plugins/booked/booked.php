<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'lione_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'lione_booked_theme_setup9', 9 );
	function lione_booked_theme_setup9() {
		if ( lione_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'lione_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'lione_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'lione_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'lione_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'lione_filter_merge_styles', 'lione_booked_merge_styles' );
			add_filter( 'lione_filter_merge_styles_responsive', 'lione_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'lione_filter_tgmpa_required_plugins', 'lione_booked_tgmpa_required_plugins' );
			add_filter( 'lione_filter_theme_plugins', 'lione_booked_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'lione_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('lione_filter_tgmpa_required_plugins',	'lione_booked_tgmpa_required_plugins');
	function lione_booked_tgmpa_required_plugins( $list = array() ) {
		if ( lione_storage_isset( 'required_plugins', 'booked' ) && lione_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && lione_is_theme_activated() ) {
			$path = lione_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || lione_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => lione_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'lione_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'lione_filter_theme_plugins', 'lione_booked_theme_plugins' );
	function lione_booked_theme_plugins( $list = array() ) {
		return lione_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}



// Check if plugin installed and activated
if ( ! function_exists( 'lione_exists_booked' ) ) {
	function lione_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'lione_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'lione_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'lione_booked_frontend_scripts', 10, 1 );
	function lione_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && lione_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$lione_url = lione_get_file_url( 'plugins/booked/booked.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-booked', $lione_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'lione_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'lione_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'lione_booked_frontend_scripts_responsive', 10, 1 );
	function lione_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && lione_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$lione_url = lione_get_file_url( 'plugins/booked/booked-responsive.css' );
			if ( '' != $lione_url ) {
				wp_enqueue_style( 'lione-booked-responsive', $lione_url, array(), null, lione_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'lione_booked_merge_styles' ) ) {
	//Handler of the add_filter('lione_filter_merge_styles', 'lione_booked_merge_styles');
	function lione_booked_merge_styles( $list ) {
		$list[ 'plugins/booked/booked.css' ] = false;
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'lione_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('lione_filter_merge_styles_responsive', 'lione_booked_merge_styles_responsive');
	function lione_booked_merge_styles_responsive( $list ) {
		$list[ 'plugins/booked/booked-responsive.css' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( lione_exists_booked() ) {
	require_once lione_get_file_dir( 'plugins/booked/booked-style.php' );
}
