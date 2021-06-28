<div class="container mx-auto py-6 max-w-7xl">
    <div class="flex justify-between items-center m-6 mx-auto px-2 sm:px-2">
        <h1 class="text-3xl font-bold">@lang('loja::address.title')</h1>
    </div>
    <div class="">
        @include('loja::livewire.partials.address')
        <div class="p-3">
            <button id="checkout-button" class="px-6 py-3 mt-6 font-medium text-white bg-green-600 rounded shadow item-center hover:bg-green-700 focus:shadow-outline focus:outline-none">
                <i class="far fa-fw fa-check"></i>
                <span class="ml-1">@lang('loja::address.submit')</span>
            </button>
        </div>
        </form> {{-- todo fix this, mettre le btn dans le partial, renommer en "address-form" ? --}}
    </div>
</div>
