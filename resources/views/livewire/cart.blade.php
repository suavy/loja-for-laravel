{{--
@if($cartItemsRemoved->count())
    <ul>
        @foreach($cartItemsRemoved as $item)
            <li>Le produit {{ $item->name }} n'est plus disponible nous l'avons supprimé du panier.</li>
        @endforeach
    </ul>
@endif
--}}
<div class="cart-container">
    @if($cartHasItems)
        <div class="cart">
            <h1 class="title cart__title">Mon Panier @auth {{ Auth::user()->firstname }} @endauth</h1>

            @include('loja::livewire.partials.products')
            @include('loja::livewire.partials.empty-button')
            @include('loja::livewire.partials.address')
            @include('loja::livewire.partials.summary')
        </div>
    @else
        <div class="cart empty__cart">
            <h2 class="empty__cart--title">Le panier est vide.</h2>
        </div>
    @endif

</div>
