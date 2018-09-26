<?php 
// part for displaying cartBlock item

// template args
$product_obj = $template_args['product'];
$qty = $template_args['qty'];
$cartitem = $template_args['cartitem'];

?>

<!-- item -->
<div class="cartBlock__product">
    <div class="cartBlock__product_Image">
        <img src="<?php echo get_the_post_thumbnail_url($product_obj->id, 'productCartThumb') ?>" alt="<?php echo $product_obj->name ?>">
    </div>
    <div class="cartBlock__product_Details">
        <div class="cartBlock__product_Title">
            <a class="linkReverse" href="<?php echo get_permalink($product_obj->id) ?>"><?php echo $product_obj->name ?></a>
        </div>
        <?php if ($product_obj->get_sku()) : ?>
            <div class="cartBlock__product_SKU">
                SKU <?php echo $product_obj->get_sku() ?>
            </div>
        <?php endif; ?>
        <div class="cartBlock__navbtns">
            <div class="cartBlock__navbtn cartBlock__navbtn--qty">
                <?php echo $qty ?>
            </div>
            <div class="cartBlock__navbtn cartBlock__navbtn--remove" data-key="<?php echo $cartitem ?>">
                X
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="cartBlock__product_Price italic">
        <?php echo $product_obj->get_price_html() ?>
    </div>
</div>