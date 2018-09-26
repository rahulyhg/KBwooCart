<?php 
// part for displaying cart module with contents 

?>
<?php if (is_cart() || is_checkout()){
    return false;
} ?>
<div class="cartBlock" data-spy="affix" data-offset-top="197">
    <div class="cartBlock__badge">
        <div class="cartBlock__cartIcon">
            <div class="cartBlock__icon">
                <i class="fas fa-shopping-basket"></i>
            </div>
            <div class="cartBlock__cartCount">
                <?php echo WC()->cart->get_cart_contents_count() ?>
            </div>
        </div>
        <span class="purple italic"><?php echo __('Twój koszyk', 'starter_theme') ?></span>
        <div class="cartBlock__close">
            <i class="fas fa-times"></i>
        </div>
    </div>
    <div class="cartBlock__container">
   
        <div class="cartBlock__products">
            <?php $cartItems = WC()->cart->get_cart( ) ?>

            <!-- if empty cart -->
            <?php if (!$cartItems) : ?>
                <div class="cartBlock__product">
                    <div class="cartBlock__empty">
                        Brak produktów w koszyku.
                    </div>
                </div>
            <?php endif; ?>
            
            <?php foreach ($cartItems as $cartItem): ?>
                <?php echo hm_get_template_part('template-parts/products/cartBlock_item',[
                    'product' => $cartItem['data'],
                    'qty' => $cartItem['quantity'],
                    'cartitem' => $cartItem['key'],
                ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="cartBlock__nav">
            <a href="<?php echo wc_get_cart_url() ?>" class="cartBlock__seeCart linkReverse">
                <?php echo __('Zobacz koszyk', 'starter_theme') ?>
            </a>
            <div class="cartBlock__cartTotal">
                <?php echo __('Wartość koszyka', 'starter_theme') ?>:
                <span class="cartBlock__total purple"><?php echo WC()->cart->get_cart_total() ?></span>
            </div>
            <a href="<?php echo wc_get_checkout_url() ?>" class="btnwine btnwine__more btnwine--reverse">
                <?php echo __('Zapłać', 'starter_theme') ?>
            </a>
        </div>
    </div>
</div>
