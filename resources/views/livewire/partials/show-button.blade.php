<div class="button cart-show-button-container">
    <a href="{{ route('loja.cart.index') }}" class="cart-show-button">
        <i class="fas fa-user cart-show-button__icon"></i>
    </a>
    @livewire('cart-counter')
</div>
