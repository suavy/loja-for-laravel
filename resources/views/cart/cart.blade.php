<main>
    <div class="container" >
    <!-- Product Wrapper -->
    @if(\Cart::isEmpty())
        Le panier est vide.
    @else
        @csrf

            <table id="js-cart">
                <tr >
                    <td style="width: 200px">Produit</td>
                    <td style="width: 200px">---Quantité</td>
                    <td style="width: 200px">---Prix</td>
                    <td style="width: 200px">---Supprimer</td>
                </tr>
                @foreach($cartItems as $item)
                    <tr style="text-align: right" class="js-cart-product" data-id="{{ $item->id }}" data-quantity-max="10">
                        <td>{{ $item->name }}</td>
                        <td><span class="js-cart-quantity">{{ $item->quantity }}</span> <span class="js-cart-update" data-update="add">+</span> <span class="js-cart-update" data-update="less"> - </span></td>
                        <td><span class="js-cart-price" > {{ $item->price }}</span></td>
                        <td><span class="js-cart-remove">X</span> </td>
                    </tr>
                @endforeach
            </table>
            <h1>Sous Total: <span id="js-cart-sub-total">{{ \Cart::getTotal() }}</span> €</h1><br/>
            <h1 id="js-empty-cart">Vider mon panier</h1>

    @endif
    </div>
</main>

@push('after-foot-scripts')
    <script>
        $(function () {

            let $subTotal = $('#js-cart-sub-total');
            let $cart = $('#js-cart');

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
                        $productQuantity.text(quantity_update);
                        $subTotal.text(data.subTotal);
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
