{{--
@if($cartItemsRemoved->count())
    <ul>
        @foreach($cartItemsRemoved as $item)
            <li>Le produit {{ $item->name }} n'est plus disponible nous l'avons supprimé du panier.</li>
        @endforeach
    </ul>
@endif
--}}
<div class="py-12">
    <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
        <div class="md:flex ">
            <div class="w-full p-4 px-5 py-5">
                <div class="">
                    <div class="col-span-2 p-5">
                        <h1 class="text-xl font-medium ">Mon Panier</h1>
                        @include('loja::livewire.partials.products')
                        <div class="flex justify-between items-center mt-6 pt-6 border-t">
                            <div class="flex items-center"> <i class="fa fa-arrow-left text-sm pr-2"></i> <a href="{{ route('home') }}" class="text-md font-medium text-blue-500">Continuer mes achats</a> </div>
                            <div class="flex justify-center items-end"> <span class="text-sm font-medium text-gray-400 mr-1">Total:</span> <span class="text-lg font-bold text-gray-800 "> {{ $totalPrice }} €</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
