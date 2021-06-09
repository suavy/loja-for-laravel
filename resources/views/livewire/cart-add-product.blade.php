<form accept-charset="utf-8" method="POST" wire:submit.prevent="addToCart">
<div class="flex py-4 space-x-4">
    <div class="relative">
        <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>
        <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1" wire:model="quantity">

            {{-- TODO USE config('loja.quantity.maximum-product'); --}}
            @for($i=1; $i<=5; $i++)
                <option value ="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
        </svg>
    </div>

    @if($product->hasAttributes())
        <div class="relative">
            <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">{{ $product->attributeSet->name }}</div>
            @foreach($product->attributeSet->attributes as $attribute)

            <select class="cursor-pointer appearance-none rounded-xl border border-gray-200 pl-4 pr-8 h-14 flex items-end pb-1" wire:model="attributes.{{ $attribute->id }}">
                <option></option>
                @foreach($attribute->values as $value)
                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                @endforeach
            </select>
            @endforeach
            <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
        </div>
    @endif

    <button class="h-14 px-6 py-2 font-semibold rounded-xl bg-lucilelight hover:bg-luciledark text-white">
        Ajouter au panier
    </button>

    <!-- Gestion des erreurs -->
    @error('quantity') {{ $message }} @enderror
    @error('attributes') {{ $message }} @enderror

    @if($productIsAddedToCart)
        <span id="loading-add-cart">Produit ajouté au panier !</span>
    @endif
</div>
</form>
