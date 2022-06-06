<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'lione_woocommerce_get_css' ) ) {
	add_filter( 'lione_filter_get_css', 'lione_woocommerce_get_css', 10, 2 );
	function lione_woocommerce_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
.woocommerce-form-login label.woocommerce-form-login__rememberme,			
.woocommerce-checkout-payment .wpgdprc-checkbox label,
.woocommerce ul.products li.product .post_header .post_tags,
#add_payment_method #payment div.payment_box,
.woocommerce-cart #payment div.payment_box,
.woocommerce-checkout #payment div.payment_box,
.woocommerce div.product .product_meta span > a,
.woocommerce div.product .product_meta span > span,
.woocommerce .checkout table.shop_table .product-name .variation,
.woocommerce .shop_table.order_details td.product-name .variation,
.woocommerce_status_bar .num,
.shop_table_checkout_review .woocommerce-shipping-totals.shipping *,
.woocommerce-checkout-payment .checkbox .woocommerce-terms-and-conditions-checkbox-text {
	{$fonts['p_font-family']}
}
.woocommerce-ordering select,
.woocommerce-grouped-product-list-item__label,
.woocommerce-grouped-product-list-item__price,
.woocommerce #review_form #respond #reply-title,
.tinv-wishlist th,
.tinv-wishlist td,
.tinv-wishlist td *,
form.woocommerce-checkout #customer_details label,
.woocommerce_status_bar,
.woocommerce .comment-form .comment-form-comment label,
.woocommerce .comment-form .comment-form-rating label,
.woocommerce .comment-form .comment-form-author label,
.woocommerce .comment-form .comment-form-email label,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta,
.woocommerce div.product form.cart .variations td.label,
.woocommerce.widget_shopping_cart .total,
.woocommerce-page.widget_shopping_cart .total,
.woocommerce .widget_shopping_cart .total,
.woocommerce-page .widget_shopping_cart .total,
.woocommerce ul.cart_list li > .amount,
.woocommerce-page ul.cart_list li > .amount,
.woocommerce ul.product_list_widget li > .amount,
.woocommerce-page ul.product_list_widget li > .amount,
.woocommerce ul.cart_list li span .amount,
.woocommerce-page ul.cart_list li span .amount,
.woocommerce ul.product_list_widget li span .amount,
.woocommerce-page ul.product_list_widget li span .amount,
.woocommerce ul.cart_list li ins .amount,
.woocommerce-page ul.cart_list li ins .amount,
.woocommerce ul.product_list_widget li ins .amount,
.woocommerce-page ul.product_list_widget li ins .amount,
.woocommerce ul.cart_list li a, .woocommerce-page ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce-page ul.product_list_widget li a,
.woocommerce ul.products li.product .post_header, .woocommerce-page ul.products li.product .post_header,
.woocommerce .shop_table th,
.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce li.product span.price,
.woocommerce div.product .summary .stock,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta strong,
.woocommerce table.cart td.product-name a, .woocommerce-page table.cart td.product-name a, 
.woocommerce #content table.cart td.product-name a, .woocommerce-page #content table.cart td.product-name a,
.woocommerce .checkout table.shop_table .product-name,
.woocommerce .shop_table.order_details td.product-name,
.woocommerce .order_details li strong,
.woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-content .woocommerce-Address-title a,
.woocommerce .woocommerce-cart-form table.shop_table tbody span.amount {
	{$fonts['h5_font-family']}
}
.woocommerce #btn-buy,
.tinv-wishlist .tinvwl_added_to_wishlist.tinv-modal button,
.woocommerce ul.products li.product .button,
.woocommerce div.product form.cart .button,
.woocommerce #review_form #respond p.form-submit input[type="submit"],
.woocommerce-page #review_form #respond p.form-submit input[type="submit"],
.woocommerce table.my_account_orders .order-actions .button,
.woocommerce .button,
.woocommerce-page .button,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce #respond input#submit,
.woocommerce .hidden-title-form a.hide-title-form,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"] {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.woocommerce button.button * {
    {$fonts['button_font-family']}
}
.woocommerce-input-wrapper,
.woocommerce table.cart td.actions .coupon .input-text,
.woocommerce #content table.cart td.actions .coupon .input-text,
.woocommerce-page table.cart td.actions .coupon .input-text,
.woocommerce-page #content table.cart td.actions .coupon .input-text {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
.woocommerce ul.products li.product .post_header .post_tags,
.woocommerce div.product .product_meta span > a, .woocommerce div.product .product_meta span > span,
.woocommerce div.product form.cart .reset_variations,
.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time, .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta time {
	{$fonts['info_font-family']}
}

CSS;
		}

		return $css;
	}
}


// Load skin-specific functions
$fdir = lione_get_file_dir( 'plugins/woocommerce/woocommerce-skin.php' );
if ( ! empty( $fdir ) ) {
	require_once $fdir;
}
