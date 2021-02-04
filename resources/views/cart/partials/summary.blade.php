<div class="cart-summary">
    <h2 class="cart-summary__title cart-summary__title--total">TOTAL</h2>
    <div class="cart-summary__holder">
        <span class="cart-summary__title cart-summary__title--subtotal">Sous-total</span>
        <span class="cart-summary__price"><span id="js-cart-sub-total">{{ \Cart::getTotal() }}</span> €</span>
    </div>
    @guest
        <div class="cart-summary__holder">
            <a href="{{ route('loja.payment.index') }}" class="button cart-summary-button cart-summary-button--checkout cart-summary-button--disabled">Paiement</a>
        </div>
        <div class="cart-summary__holder">
            <p class="cart-summary__subscription"><a href="#">Connectez-vous</a> ou <a href="#">inscrivez-vous</a> pour pouvoir remplir vos informations de livraison et procéder au paiement.</p>
        </div>
    @elseguest
        <div class="cart-summary__holder">
            <a href="{{ route('loja.payment.index') }}" class="button cart-summary-button cart-summary-button--checkout">Paiement</a>
        </div>
        <div class="cart-summary__holder">
            <p>Nous acceptons : <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-amex"></i></p>
        </div>
    @endguest
</div>
