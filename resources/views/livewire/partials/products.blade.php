@foreach($cartItems as $item)
<div class="flex justify-between items-center mt-6 pt-6  border-t">
    <div class="flex items-center"> <img src="{!! $item->associatedModel->cover !!}" width="60" class="rounded-lg ">
        <div class="flex flex-col ml-3"> <span class="md:text-md font-medium">{{ $item->name }}</span>
            @foreach($item->attributes as $attribute)
                <span class="text-xs font-light text-gray-400">{{ $attribute }}</span>
            @endforeach
        </div>
    </div>

    <div class="flex justify-center items-center">
        <div class="pr-8 flex ">
            <span class="font-semibold" wire:click="lessQuantity('{{$item->id}}')">-</span>
            <input type="text" class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2" value="{{ $item->quantity }}">
            <span class="font-semibold" wire:click="addQuantity('{{$item->id}}')">+</span>
        </div>
        <div class="pr-8 "> <span class="text-xs font-medium">{{ $item->price }}</span> </div>

        <div wire:click="removeProduct('{{$item->id}}')"> <i class="fad fa-trash-alt text-xs font-medium"></i> </div>
    </div>
</div>
@endforeach

{{--
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
--}}
