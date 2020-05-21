<form method="POST" id="product-add-cart" action="{{ route('loja.cart.product.add',$product) }}">
    @csrf
    <input type="text" name="quantity" value="1" id="product-quantity">
    <input type="text" value="10" id="product-quantity-total">
    <span>Quantité <span id="product-quantity-add">+</span><span id="product-quantity-text">1</span><span id="product-quantity-less">-</span></span>
    <div class="form-group">
        <button id="product-button" class="btn btn-success btn-submit">Ajouter au panier</button>
        <span id="loading-add-cart" style="display: none">...</span>
    </div>
</form>
<span class="" id="error-message">TEST</span>

@push('after-foot-scripts')
    <script>

        let $product_button = $('#product-button');
        let $loading_add_cart = $('#loading-add-cart');
        let $product_quantity_text = $('#product-quantity-text');
        let $product_quantity = $('#product-quantity');
        let $cart_quantity = $('#js-cart-quantity');
        let $error_message = $('#error-message');

        let quantity_total = parseInt($('#product-quantity-total').val());
        let quantity = parseInt($product_quantity.val());
        let cart_quantity = parseInt($cart_quantity.text());


        function update_cart_quantity(cart_quantity){
            $cart_quantity.text(cart_quantity);
        }

        function reset_quantity_product(){
            quantity = 1;
            $product_quantity_text.text(quantity);
            $product_quantity.val(quantity);
        }

        $('#product-quantity-add').click(function(){
            if(quantity+1 > quantity_total){
                return false;
            }
            quantity += 1;
            $product_quantity_text.text(quantity);
            $product_quantity.val(quantity);
        });

        $('#product-quantity-less').click(function(){
            if(quantity-1 < 1){
                return false;
            }
            quantity -= 1;
            $product_quantity_text.text(quantity);
            $product_quantity.val(quantity);
        });

        $('#product-add-cart').submit(function (e) {
            e.preventDefault(false);

            $product_button.hide();
            $loading_add_cart.show();

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                success: function (data) {
                    if(data.status === "error"){
                        $error_message.text(data.message)
                    }else {
                        update_cart_quantity(data.cartQuantity);
                    }

                    $product_button.show();
                    $loading_add_cart.hide();
                    reset_quantity_product();

                },
                error: function(data){
                    console.log(data);
                },
                dataType: 'JSON'
            });

            return false;
        });

    </script>
@endpush
