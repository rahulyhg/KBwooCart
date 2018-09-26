# KBwooCart
Fully responsive ajax cart for woocommerce

## Usage

1. Copy JS file to your_theme_catalog/js/cartBlock.min.js and include to your header/footer section "<?php wp_enqueue_script( 'cartBlock', get_template_directory_uri().'/js/cartBlock.min.js' ); ?>".
2. Include _cartBlock.scss file into your main scss file, then compile it and add to your project.
3. Copy template-parts folder into your wordpress theme catalog: "your_theme_catalog/template-parts".
4. Add functions and one thumb size from functions.php file into your functions.php file your_theme_catalog/functions.php.
5. Include "<?php echo get_template_part('template-parts/products/cartBlock') ?>" into your_theme_catalog/footer.php
6. Enjoy.