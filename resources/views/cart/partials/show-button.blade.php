<div class="button cart-show-button-container">
    <a href="{{ route('loja.cart.index') }}" class="cart-show-button">
        <i class="fas fa-shopping-bag cart-show-button__icon"></i>
        <span class="cart-show-button__count" id="js-cart-quantity">{{ \Cart::session(session()->getId())->getTotalQuantity() }}</span>
    </a>
</div>
