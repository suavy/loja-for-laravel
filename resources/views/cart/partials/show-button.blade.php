<div class="cart-show-button-container">
    <a href="{{ route('loja.cart.index') }}" class="cart-show-button">
        <i class="fad fa-shopping-cart cart-show-button__icon"></i>
        <span class="cart-show-button__count" id="js-cart-quantity">{{ \Cart::session(session()->getId())->getTotalQuantity() }}</span>
    </a>
</div>
