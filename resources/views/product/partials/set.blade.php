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

