@csrf
@if($cartItemsRemoved->count())
    <ul>
    @foreach($cartItemsRemoved as $item)
         <li>Le produit {{ $item->name }} n'est plus disponible nous l'avons supprimé du panier.</li>
    @endforeach
    </ul>
@endif
<div class="cart-products">
</div>
<div class="cart-products">
    @foreach($cartItems as $item)
        <div class="cart-product js-cart-product" data-id="{{ $item->id }}" data-quantity-max="100">
            <div class="cart-product__picture">
                <img src="" />
            </div><!--
            --><div class="cart-product__content">
                <div class="cart-product__content__price">{{ $item->price }}</div>
                <div class="cart-product__content__name">{{ $item->name }}</div>
                <div class="quantity cart-product__content__quantity">
                    <span class="quantity__update quantity__update--less js-cart-update" data-update="less">-</span>
                    <span class="quantity__current js-cart-quantity">{{ $item->quantity }}</span>
                    <span class="quantity__update quantity__update--more js-cart-update" data-update="add">+</span>
                </div>
            </div><!--
            --><div class="cart-product__remove">
                <i class="far fa-fw fa-trash-alt js-cart-remove"></i>
            </div><!--
            -->@if($cartItemsProblemQuantity->has($item->id))<div>
                La quantité demandé n'est plus disponible, nous avons mis à jour le panier avec la quantité restante.
            </div>@endif
        </div>
    @endforeach
</div>

@push('after-foot-scripts')
    <script>
        $(function () {

            let $subTotal = $('#js-cart-sub-total');
            let $cart = $('#js-cart');
            let $cartQuantity = $('#js-cart-quantity');

            let cart_is_updating = false;
            let url_cart_product_remove = '/cart/remove/';
            let url_cart_product_update = '/cart/update/';
            let url_cart_empty = '/cart/empty';

            let csrf = $('input[name="_token"]').val();

            $(document).on('click','#js-empty-cart',function () {
                cart_is_updating=true;
                $.ajax({
                    type: "POST",
                    url: url_cart_empty,
                    data: {_token:csrf},
                    success: function (data) {
                        $cart.html('').text('Le panier est vide.');
                        $cartQuantity.text(data.cartQuantity);
                        cart_is_updating = false;
                    },
                    error: function(data){
                        console.log(data);
                        cart_is_updating = false;
                    },
                    dataType: 'JSON'
                });
            });

            // Cart update product add quantity
            $(document).on('click','.js-cart-update',function () {

                if(cart_is_updating)
                    return false;

                cart_is_updating = true;

                let $product = $(this).closest('.js-cart-product');
                let $productQuantity = $product.find('.js-cart-quantity');
                let update_mode = $(this).data('update');
                let quantity = parseInt($productQuantity.text());
                let quantity_max = parseInt($product.data('quantity-max'));
                let quantity_update = quantity;

                if(update_mode === "add")
                    quantity_update += 1;
                else
                    quantity_update -= 1;

                console.log(quantity_update);

                if(quantity_update < 1 || quantity_update > quantity_max) {
                    cart_is_updating = false;
                    return false; //todo error quantity
                }


                $.ajax({
                    type: "POST",
                    url: url_cart_product_update+$product.data('id'),
                    data: {_token:csrf,update_mode:update_mode},
                    success: function (data) {
                        console.log(data);
                        $productQuantity.text(quantity_update);
                        $subTotal.text(data.subTotal);
                        $cartQuantity.html(data.cartQuantity);
                        cart_is_updating = false;
                    },
                    error: function(data){
                        console.log(data);
                        cart_is_updating = false;
                    },
                    dataType: 'JSON'
                });
            });
            // Cart remove product
            $(document).on('click','.js-cart-remove',function () {
                let $product = $(this).closest('.js-cart-product');

                $.ajax({
                    type: "POST",
                    url: url_cart_product_remove+$product.data('id'),
                    data: {_token:csrf},
                    success: function (data) {
                        $product.remove();
                        $subTotal.text(data.subTotal);
                        $cartQuantity.text(data.cartQuantity);
                    },
                    error: function(data){
                        console.log(data);
                    },
                    dataType: 'JSON'
                });
            });

        });
    </script>
@endpush
