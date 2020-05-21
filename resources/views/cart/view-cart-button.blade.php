<div class="cart-container">
    <a href="{{ route('loja.cart.index') }}" class="cart">
        <i class="fad fa-shopping-cart cart__icon"></i>
        <span class="cart__count" id="js-cart-quantity">{{ \Cart::session(session()->getId())->getTotalQuantity() }}</span>
    </a>
</div>

