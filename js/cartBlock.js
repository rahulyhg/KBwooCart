(function ($) {

    $(document).ready(function(){

        // Remove item from cart
        $(document.body).on('click', '.cartBlock__navbtn--remove', function(e){
            e.preventDefault();
            var $product_key = $(this).attr('data-key');
            $.ajax({
                url: ajax_url,
                type: "POST",
                dataType: "json",
                data: {
                'action': 'remove_item_from_cart',
                'product_key': $product_key
                },
                success:function(){
                    $(document.body).trigger('cart_update');
                },
                error: function(){
                    console.log('Nie udało się zaaktualizować ilości elementów w koszyku.')
                }
            });
            
        });

        $(document.body).on('cart_update', get_cart_contents);
        
        function get_cart_contents(){
            var $output;
            $.ajax({
                url: ajax_url,
                type: "POST",
                dataType: "json",
                data: {
                'action': 'get_cart_contents',
                },
                success:function(response){
                    var cartparams = {
                        'container_count': $('.cartBlock__cartCount'),
                        'container_total': $('.cartBlock__total'),
                        'container_productsCount': $('.cartBlock__badge small'),
                        'container_products': $('.cartBlock__products'),
                        'cart_count': response['cart_count'],
                        'cart_total': response['cart_total']
                    }
                    var products = [];
                    for (const product in response['products']) {
                        products.push(new cartBlockItem(response['products'][product]));
                    }
                    var cartBlockObject = new cartBlock(cartparams, products);

                    cartBlockObject.update_cart();
                },
                error: function(){
                    console.log('Nie udało się zaaktualizować ilości elementów w koszyku.')
                }
            });

        }

    }) // document ready

        class cartBlock {

            constructor(params, products) {
                this.container_count = params['container_count'];
                this.container_total = params['container_total'];
                this.container_productsCount = params['container_productsCount'];
                this.container_products = params['container_products'];
                this.products = products;
                this.cart_count = params['cart_count'];
                this.cart_total = params['cart_total'];
                self = this;
            }

            update_cart(){
                this.update_cart_total();
                this.update_cart_count();
                this.update_cart_products();
            }

            update_cart_total(){
                this.container_total.html(self.cart_total);
            }            
            update_cart_count(){
                this.container_count.html(self.cart_count);
                this.container_count.addClass('bounce');
                setTimeout(function(){ 
                    self.container_count.removeClass('bounce');
                }, 1000);
            }
            update_cart_products(){
                var productsHTML = '';

                if (this.products.length > 0) {
                    for (const product in this.products) {
                        productsHTML += this.products[product].generate_cart_item(); 
                    }
                }else{
                    productsHTML += this.generate_empty_cart_item(); 
                }

                this.container_products.html(productsHTML);
            }

            generate_empty_cart_item(){
                var $output =`<div class="cartBlock__product">
                    <div class="cartBlock__empty">
                        Brak produktów w koszyku.
                    </div>
                </div>`;

                return $output;
            }

        }

        class cartBlockItem {

            constructor(params) {
                this.qty = params['qty'];
                this.sku = params['sku'];
                this.cart_key = params['cart_key'];
                this.name = params['name'];
                this.thumb_url = params['thumb_url'];
                this.product_url = params['product_url'];     
                this.price = params['price'];     
            }

            generate_cart_item(){
                var $output =`<div class="cartBlock__product" data-key="${this.cart_key}">
                    <div class="cartBlock__product_Image">
                        <img src="${this.thumb_url}" alt="${this.name}">
                    </div>
                    <div class="cartBlock__product_Details">
                        <div class="cartBlock__product_Title">
                            <a class="linkReverse" href="${this.product_url}">${this.name}</a>
                        </div>
                        <div class="cartBlock__product_SKU">
                            SKU ${this.sku}
                        </div>
                        <div class="cartBlock__navbtns">
                            <div class="cartBlock__navbtn cartBlock__navbtn--qty">
                                ${this.qty}
                            </div>
                            <div class="cartBlock__navbtn cartBlock__navbtn--remove" data-key="${this.cart_key}">
                                X
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="cartBlock__product_Price italic">
                        ${this.price}
                    </div>
                </div>`;

                return $output;
            }

        }

})(jQuery);

