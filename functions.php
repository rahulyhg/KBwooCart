<?php
// Required functions and thumb size

add_image_size( 'productCartThumb', 80, 100, false);

function get_cart_contents(){
	$cart = WC()->cart->get_cart();

	$cart_count = WC()->cart->get_cart_contents_count();
	$cart_total = WC()->cart->get_cart_total();

	foreach ($cart as $cart_item) {
		$products[] = [
			'qty' => $cart_item['quantity'],
			'sku' => $cart_item['data']->sku,
			'cart_key' => $cart_item['key'],
			'name' => $cart_item['data']->name,
			'thumb_url' => get_the_post_thumbnail_url($cart_item['product_id'], 'productCartThumb'),
			'product_url' => get_permalink($cart_item['product_id']),
			'price' => $cart_item['data']->get_price_html()
		];
	}

	$response = [
		'products' => $products,
		'cart_count' => $cart_count,
		'cart_total' => $cart_total
	];

	wp_send_json( $response );

}

add_action('wp_ajax_get_cart_contents', 'get_cart_contents');
add_action('wp_ajax_nopriv_get_cart_contents', 'get_cart_contents');

function remove_item_from_cart() {
	WC()->cart->remove_cart_item($_POST['product_key']);
}

add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');