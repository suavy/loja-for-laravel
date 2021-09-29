<form accept-charset="utf-8" method="POST" wire:submit.prevent="addToCart">
<div class="flex py-4 space-x-4">

    @if($product->enabled)
        <div class="relative pl-4 pr-8 h-14">
            <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">Qty</div>
            <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
            <select class="absolute cursor-pointer appearance-none rounded-xl border border-gray-200 flex items-end w-full pointer-events-auto focus:outline-none bg-transparent w-full h-full left-0 top-0 pb-2 pl-2" wire:model="quantity">
                {{-- TODO USE config('loja.quantity.maximum-product'); --}}
                @for($i=1; $i<=5; $i++)
                    <option value ="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        @if($product->hasAttributes())
            <div class="relative pl-8 pr-12 h-14">
                <div class="text-center left-0 pt-2 right-0 absolute block text-xs uppercase text-gray-400 tracking-wide font-semibold">{{ $product->attributeSet->name }}</div>
                <svg class="w-5 h-5 text-gray-400 absolute right-0 bottom-0 mb-2 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg>
                @foreach($product->attributeSet->attributes as $attribute)

                <select class="absolute cursor-pointer appearance-none rounded-xl border border-gray-200 flex items-end w-full pointer-events-auto focus:outline-none bg-transparent w-full h-full left-0 top-0 pb-2 pl-2" wire:model="attributes.{{ $attribute->id }}">
                    <option></option>
                    @foreach($attribute->values as $value)
                        <option value="{{ $value->id }}">{{ $value->value }}</option>
                    @endforeach
                </select>
                @endforeach
            </div>
        @endif
        <button class="h-14 px-6 py-2 font-semibold rounded-xl bg-lucilelight hover:bg-luciledark text-white ">
            Ajouter au panier
        </button>
    @else
        <h2 class="mb-2 leading-tight tracking-tight text-gray-800 text-2xl md:text-3xl">Rupture de stock</h2>
    @endif

</div>

    <!-- Gestion des erreurs -->
    @error('quantity')
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500 bg-opacity-1">
          <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
          </span>
        <span class="inline-block align-middle mr-8">
              {{ $message }}
          </span>
    </div>
    @enderror

    @error('attributes')
    <div class="flex text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500 bg-opacity-1">
        <span class="inline-block align-middle mr-8">
                  La séléction du cadre est obligatoire
              </span>
    </div>
    @enderror

    @if($productIsAddedToCart)
        <div class="flex px-6 py-4 relative mb-4">
            <span class=" text-luciledark text-3xl">Produit ajouté au panier !</span>
        </div>
    @endif

</form>


