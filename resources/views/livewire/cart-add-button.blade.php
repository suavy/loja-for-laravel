<div>
@if($product->attributeSet && $product->attributeSet->attributes)
    @foreach($product->attributeSet->attributes as $attribute)
        <div class="select-dropdown">
            <select name="attribute" class="js-select-attribute">
                @foreach($attribute->values as $value)
                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                @endforeach
            </select>
        </div>
    @endforeach
@endif
<div class="quantity">
    <span wire:click="less" class="quantity__update quantity__update--less">-</span>
    <span class="quantity__current">{{ $quantityToAdd }}</span>
    <span wire:click="add" class="quantity__update quantity__update--more" >+</span>
</div>
<form method="POST" id="product-add-cart" action="">
    @csrf
    <input type="hidden" name="quantity" value="1" id="product-quantity">
    <div class="form-group">
        <button id="product-button" class="btn btn-success btn-submit">Ajouter au panier</button>
        <span id="loading-add-cart" style="display: none">...</span>
    </div>
</form>
<!-- todo tant que la quantité n'est pas géré, le message d'erreur est inutile -->
<span class="" id="error-message"></span>
</div>
