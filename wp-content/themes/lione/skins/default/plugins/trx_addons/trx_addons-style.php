<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'lione_trx_addons_get_css' ) ) {
	add_filter( 'lione_filter_get_css', 'lione_trx_addons_get_css', 10, 2 );
	function lione_trx_addons_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

[class*="trx_addons_title_with_link"],
.sc_price_item .sc_price_item_subtitle,
.sc_dishes_compact .sc_services_item_title,
.sc_services_iconed .sc_services_item_title,
.sc_services_fashion .sc_services_item_subtitle,
.sc_icons_plain .sc_icons_item:not(.sc_icons_item_linked) .sc_icons_item_link {
	{$fonts['p_font-family']}
}

.widget .trx_addons_tabs .trx_addons_tabs_titles li,
.trx_addons_video_list_controller_wrap .trx_addons_video_list_subtitle,
.trx_addons_video_list_controller_wrap .trx_addons_video_list_image_label,
.trx_addons_audio_wrap .trx_addons_audio_navigation,
.services_page_tabs.trx_addons_tabs .trx_addons_tabs_titles li > a,
.sc_events_item_price,
.sc_events_item_date_day,
.sc_events_item_meta_locality,
.tabs_style_2.elementor-widget-tabs .elementor-tab-title,
.trx_addons_list_parameters,
.sc_events_item_more_link,
.sc_events_item_meta_categories a,
.scroll_to_top_style_modern,
.sc_blogger_default.sc_blogger_default_classic_time_2 .post_meta.sc_blogger_item_meta.post_meta_date,
.sc_blogger_default.sc_blogger_default_classic_time .post_meta.sc_blogger_item_meta.post_meta_date,
.team_member_brief_info_details .team_member_details_phone .team_member_details_value ,
.sc_socials.sc_socials_icons_names .social_item .social_name,
.services_single .services_page_featured .sc_services_item_price,
.sc_services .sc_services_item_price,
.sc_services .sc_services_item_subtitle,
.sc_services .sc_services_item_number,
.wp-playlist.wp-audio-playlist .wp-playlist-tracks,
.wp-playlist.wp-audio-playlist .wp-playlist-item-title,
.social_item.social_item_type_names .social_name,
.sc_countdown .sc_countdown_label,
.sc_countdown_default .sc_countdown_digits,
.sc_countdown_default .sc_countdown_separator,
.toc_menu_item .toc_menu_description,
.sc_recent_news .post_item .post_footer .post_meta .post_meta_item,
.sc_icons_item_title,
.sc_price_item_title, .sc_price_item_price .sc_price_item_price_value,
.sc_courses_default .sc_courses_item_price,
.sc_courses_default .trx_addons_hover_content .trx_addons_hover_links a,
.sc_events_classic .sc_events_item_price,
.sc_events_classic .trx_addons_hover_content .trx_addons_hover_links a,
.sc_skills_counter .sc_skills_total,
.sc_skills_counter_modern .sc_skills_total, 
.sc_skills_pie.sc_skills_compact_off .sc_skills_total,
.sc_skills_counter_modern .sc_skills_item_title,
.sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
.sc_icons_number .sc_icons_item_number,
.sc_services .sc_services_item_more_link,
.slider_container .slide_info.slide_info_large .slide_title,
.slider_style_modern .slider_controls_label span + span,
.sc_slider_controller_info,
.trx_addons_dropcap {
	{$fonts['h5_font-family']}
}

.sc_recent_news .post_item .post_meta,
.sc_price_item_description,
.sc_price_item_details,
.sc_courses_default .sc_courses_item_date,
.courses_single .courses_page_meta,
.sc_events_classic .sc_events_item_date,
.sc_skills_counter .sc_skills_item_title,
.slider_style_modern .slider_controls_label span,
.slider_titles_outside_wrap .slide_cats,
.slider_titles_outside_wrap .slide_subtitle,
.sc_slider_controller_item_info_date,
.sc_team .sc_team_item_subtitle,
.sc_dishes .sc_dishes_item_subtitle,
.sc_services .sc_services_item_subtitle,
.team_member_page .team_member_brief_info_text,
.sc_testimonials_item_author_title,
.sc_testimonials_item_content:before {
	{$fonts['info_font-family']}
}
.slider_outer_wrap .sc_slider_controller .sc_slider_controller_item_info_date {
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}	
}
.sc_button:not(.sc_button_simple),
.sc_button.sc_button_simple,
.sc_form button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.sc_button.sc_button_animated,
.sc_blogger	.sc_blogger_item_button .item_more_link {
	{$fonts['button_font-family']}
}

.slider_pagination_style_title.sc_slider_controls_light .slider_pagination_wrap .slider_pagination_bullet,
.sc_title_default h5.sc_item_title_tag + .sc_title_subtitle,
.sc_portfolio.sc_portfolio_default .sc_portfolio_item .post_featured .post_info .post_meta .post_categories,
.sc_style_toggle .sc_blogger .sc_item_filters_wrap .sc_item_filters .sc_item_filters_header .sc_item_filters_subtitle,
.sc_blogger_lay_portfolio_grid .sc_blogger_item .post_meta .post_meta_item,
.sc_blogger_lay_portfolio .sc_blogger_item .post_meta .post_meta_item {
    {$fonts['p_font-family']}
}
CSS;
		}

		return $css;
	}
}
