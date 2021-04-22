<form accept-charset="utf-8" class="form form--horizontal" method="POST" wire:submit.prevent="addToCart">

    @if($product->attributeSet && $product->attributeSet->attributes)
        <div class="attributeSetParentClass">
        @foreach($product->attributeSet->attributes as $attribute)
            <div class="attributeSetClass (select-dropdown)">
                <select name="attribute" class="attributeSetSelectClass" wire:model="attributes">
                    <option></option>
                    @foreach($attribute->values as $value)
                        <option value="{{ $value->id }}">{{ $value->value }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        </div>
    @endif

    <div class="quantityParentCl">
        <span wire:click="lessQuantity" class="quantity__update quantity__update--less">-</span>
        <span class="quantity__current">{{ $quantity }}</span>
        <span wire:click="addQuantity" class="quantity__update quantity__update--more" >+</span>
    </div>


    <input type="hidden" name="quantity" value="1" id="product-quantity">
    <div class="form-group">
        <button  class="btn btn-success btn-submit">Ajouter au panier</button>
        @if($productIsAddedToCart)
            <span id="loading-add-cart">Produit ajouté au panier !</span>
        @endif
        <span id="loading-add-cart" style="display: none">...</span>
    </div>

    <!-- todo tant que la quantité n'est pas géré, le message d'erreur est inutile -->
    <span class="" id="error-message"></span>
</form>
