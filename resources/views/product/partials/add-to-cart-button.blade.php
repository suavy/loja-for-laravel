<!-- TODO USE THIS BLOCK -->
<div class="quantity">
    <span class="quantity__update quantity__update--less js-quantity-update" data-update="less">-</span>
    <span class="quantity__current" id="product-quantity-text">1</span>
    <span class="quantity__update quantity__update--more js-quantity-update" data-update="add">+</span>
</div>
<form method="POST" id="product-add-cart" action="{{ route('loja.cart.product.add',$product) }}">
    @csrf
    <input type="hidden" name="quantity" value="1" id="product-quantity">
    <div class="form-group">
        <button id="product-button" class="btn btn-success btn-submit">Ajouter au panier</button>
        <span id="loading-add-cart" style="display: none">...</span>
    </div>
</form>
<!-- todo tant que la quantité n'est pas géré, le message d'erreur est inutile -->
<span class="" id="error-message"></span>

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

        $('.js-quantity-update').click(function(){
            let update_mode = $(this).data('update');
            let quantity_update;

            if(update_mode === "add")
                quantity_update = 1;
            else
                quantity_update = -1;

            if(quantity+quantity_update < 1) {
                return false;
            }

            quantity += quantity_update;
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
