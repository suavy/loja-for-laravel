<div class="container mx-auto py-6 max-w-7xl">
    <div class="flex justify-between items-center m-6 mx-auto px-2 sm:px-2">
        <h1 class="text-3xl font-bold">Mon panier</h1>
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="text-md font-medium bg-gray-100 rounded px-3 py-2 text-gray-900 hover:bg-gray-200 border-2 border-gray-200">@lang('loja::cart.continue-shopping') <i class="fa fa-arrow-right text-sm pl-1"></i></a>
        </div>
    </div>
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full text-gray-800">
            <div class="flex-1">
                {{-- Products --}}
                <div class="bg-gray-100 p-8 rounded mx-2">
                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                        <tr class="">
                            <th class="hidden md:table-cell"></th>
                            <th class="text-left">@lang('loja::cart.table.product')</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity">@lang('loja::cart.table.quantity-xs')</span>
                                <span class="hidden lg:inline">@lang('loja::cart.table.quantity')</span>
                            </th>
                            <th class="hidden text-right md:table-cell">@lang('loja::cart.table.unit-price')</th>
                            <th class="text-right">@lang('loja::cart.table.total-price')</th>
                            <th class=""></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="hidden pb-2 md:table-cell">
                                    <a href="#">
                                        <img src="https://limg.app/i/Calm-Cormorant-Catholic-Pinball-Blaster-yM4oub.jpeg" class="w-20 rounded" alt="Thumbnail">
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        <p>{{ $item->name }}</p>
                                        @foreach($item->attributes as $attribute)
                                            <span class="text-xs font-light text-gray-400">{{ $attribute }}</span>
                                        @endforeach
                                    </a>
                                </td>
                                <td class="justify-center md:justify-end md:flex mt-6">
                                    <div class="">
                                        <div class="flex">
                                            <span class="font-semibold cursor-pointer" wire:click="lessQuantity('{{$item->id}}')">-</span>
                                            <input type="text" class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2" value="{{ $item->quantity }}">
                                            <span class="font-semibold cursor-pointer" wire:click="addQuantity('{{$item->id}}')">+</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm lg:text-base font-medium">{{ $item->price }}€</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-sm lg:text-base font-medium">{{ $item->price * $item->quantity }}€</span>
                                </td>
                                <td class="text-right">
                                    <span class="text-sm lg:text-base font-medium cursor-pointer" wire:click="removeProduct('{{$item->id}}')"> <i class="fal fa-trash-alt"></i> </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @guest
                    <hr class="pb-6 mt-6">
                    Total: {{ $totalPrice }}
                    <br>
                    <p>
                        <a class="font-medium" href="{{route('login')}}" >Se connecter</a> ou <a class="font-medium" href="{{route('login')}}" >S'inscrire</a>
                        pour valider la commande.
                    </p>
                @endguest
                @auth
                    <form wire:submit.prevent="checkout" method="post">
                    <div class="my-4 mt-6 -mx-2 lg:flex">
                        {{-- Delivery address --}}
                        <div class="lg:px-2 lg:w-1/2 rounded p-0 sm:px-6 sm:py-2 border-2 m-4">
                            <div class="p-4 pb-2">
                                <h1 class="font-bold text-xl">@lang('loja::cart.address.title')</h1>
                            </div>
                            @include('loja::livewire.partials.address')

                        </div>
                        {{-- Order Details --}}
                        <div class="lg:px-2 lg:w-1/2 rounded p-0 sm:px-6 sm:py-2 border-2 m-4">
                            <div class="p-4 pb-2">
                                <h1 class="font-bold text-xl">@lang('loja::cart.details.title')</h1>
                            </div>
                            {{-- Coupon Code --}}
                            <div class="p-4">
                                <p class="italic text-sm pb-1 ">@lang('loja::cart.details.coupon-label')</p>
                                <div class="justify-center md:flex">
                                    <div class="flex items-center w-full h-12 pl-3 bg-white bg-gray-100 border rounded">
                                        <input type="coupon" name="code" id="coupon" placeholder="Apply coupon" value="90off"
                                               class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none"/>
                                        <button type="submit" class="text-sm flex items-center px-3 py-1 text-white bg-gray-800 rounded outline-none md:px-8 hover:bg-gray-700 focus:outline-none active:outline-none">
                                            <i class="far fa-lg fa-fw fa-gift pr-6"></i>
                                            <span class="font-medium">@lang('loja::cart.details.coupon-button')</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-bold text-center text-gray-800">@lang('loja::cart.details.subtotal')</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalPrice }}€</div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="flex lg:px-4 lg:py-2 m-2 text-lg font-semibold text-gray-800">
                                        <form action="" method="POST">
                                            <button type="submit" class="mr-2 text-red-600 hover:text-red-800">
                                                <i class="fal fa-times"></i>
                                            </button>
                                        </form>
                                        Coupon "couponSlug" -20%
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-600">
                                        -133,944.77€
                                    </div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">@lang('loja::cart.details.shipping-cost')</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">14,882.75€</div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">@lang('loja::cart.details.total')</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalPrice }}€</div>
                                </div>
                                <div class="text-center">
                                    <button id="checkout-button" class="mx-auto px-6 py-3 mt-6 font-medium text-white bg-green-600 rounded shadow item-center hover:bg-green-700 focus:shadow-outline focus:outline-none">
                                        <i class="far fa-fw fa-credit-card"></i>
                                        <span class="ml-1">@lang('loja::cart.details.checkout-button')</span>
                                    </button>
                                </div>


                            </div>
                        </div>
                    </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- Todo à voir avec Matthieu--}}
<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("{{ env('STRIPE_PUBLIC_KEY') }}");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
        fetch("{{ route('loja.payment.create-checkout-session') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
                // If redirectToCheckout fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using error.message.
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error:", error);
            });
    });
</script>
