<?php
/**
 * Required plugins
 *
 * @package LIONE
 * @since LIONE 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$lione_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'lione' ),
	'page_builders' => esc_html__( 'Page Builders', 'lione' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'lione' ),
	'socials'       => esc_html__( 'Socials and Communities', 'lione' ),
	'events'        => esc_html__( 'Events and Appointments', 'lione' ),
	'content'       => esc_html__( 'Content', 'lione' ),
	'other'         => esc_html__( 'Other', 'lione' ),
);
$lione_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'lione' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'lione' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $lione_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'lione' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'lione' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $lione_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'lione' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'lione' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $lione_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'lione' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'lione' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $lione_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'lione' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'lione' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $lione_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'lione' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'lione' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $lione_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'lione' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'lione' ),
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => 'instagram-feed.png',
		'group'       => $lione_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'lione' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'lione' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $lione_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'lione' ),
		'description' => '',
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => 'booked.png',
		'group'       => $lione_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'lione' ),
		'description' => '',
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => 'the-events-calendar.png',
		'group'       => $lione_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'lione' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'lione' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $lione_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'lione' ),
		'description' => '',
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => lione_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $lione_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'lione' ),
		'description' => '',
		'required'    => false,
		'logo'        => lione_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'lione' ),
		'description' => '',
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => lione_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'lione' ),
		'description' => '',
		'required'    => false,
		'logo'        => lione_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $lione_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'lione' ),
		'description' => '',
		'required'    => false,
        'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
        'logo'        => lione_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'lione' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'lione' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'lione' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'lione' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $lione_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'lione' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'lione' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $lione_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'lione' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'lione' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $lione_theme_required_plugins_groups['other'],
	),
);

if ( LIONE_THEME_FREE ) {
	unset( $lione_theme_required_plugins['js_composer'] );
	unset( $lione_theme_required_plugins['booked'] );
	unset( $lione_theme_required_plugins['the-events-calendar'] );
	unset( $lione_theme_required_plugins['calculated-fields-form'] );
	unset( $lione_theme_required_plugins['essential-grid'] );
	unset( $lione_theme_required_plugins['revslider'] );
	unset( $lione_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $lione_theme_required_plugins['trx_updater'] );
	unset( $lione_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
lione_storage_set( 'required_plugins', $lione_theme_required_plugins );
