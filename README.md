# KBwooCart
Fully responsive ajax cart for woocommerce

## Usage

1. Copy JS file to **your_theme_catalog/js/cartBlock.min.js** and include to your header/footer section:
```
<?php wp_enqueue_script( 'cartBlock', get_template_directory_uri().'/js/cartBlock.min.js' ); ?>.
```
2. Include **_cartBlock.scss** file into your main scss file, then compile it and add to your project.
3. Copy template-parts folder into your wordpress theme catalog: **"your_theme_catalog/template-parts"**.
4. Add functions and one thumb size from functions.php file into your functions.php file **your_theme_catalog/functions.php**.
### Functions
```
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
```
### Thumb size:
```
add_theme_support( 'post-thumbnails' );
add_image_size( 'productCartThumb', 80, 100, false);
```
5. Include:
```
<?php echo get_template_part('template-parts/products/cartBlock') ?>
```
into your_theme_catalog/footer.php

6. **Enjoy**.
