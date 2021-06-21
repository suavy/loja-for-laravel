<div class="container mx-auto py-6 max-w-7xl">
    <div class="flex justify-between items-center m-6 mx-auto px-2 sm:px-2">
        <h1 class="text-3xl font-bold">@lang('loja::address.title')</h1>
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-md font-medium bg-gray-100 rounded px-3 py-2 text-gray-900 hover:bg-gray-200 border-2 border-gray-200">@lang('loja::cart.continue-shopping') <i class="fa fa-arrow-right text-sm pl-1"></i></a>
        </div>
    </div>
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full text-gray-800">
            <div class="flex-1">
                <div class="p-8 rounded mx-2">
                    @include('loja::livewire.partials.address')
                    <button id="checkout-button" class="mx-auto px-6 py-3 mt-6 font-medium text-white bg-green-600 rounded shadow item-center hover:bg-green-700 focus:shadow-outline focus:outline-none">
                        <i class="far fa-fw fa-credit-card"></i>
                        <span class="ml-1">@lang('loja::address.submit')</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
