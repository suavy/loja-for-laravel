@if($cartItemsRemoved->count())
    <ul>
        @foreach($cartItemsRemoved as $item)
            <li>Le produit {{ $item->name }} n'est plus disponible nous l'avons supprimé du panier.</li>
        @endforeach
    </ul>
@endif
Le panier est vide.
