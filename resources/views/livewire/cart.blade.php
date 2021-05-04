<div>
    <div class="flex justify-between items-center mt-6 pt-6 md:w-4/5 lg:w-4/5 mx-auto">
        <div class="flex items-center pl-6 lg:pl-0">
            <a href="{{ route('home') }}" class="text-md font-medium text-blue-500"><i class="fa fa-arrow-left text-sm pr-2"></i>  Continuer mes achats</a>
        </div>
    </div>
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5 rounded-md">
            <div class="flex-1">
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12 uppercase">
                            <th class="hidden md:table-cell"></th>
                            <th class="text-left">Product</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity">Qtd</span>
                                <span class="hidden lg:inline">Quantity</span>
                            </th>
                            <th class="hidden text-right md:table-cell">Unit price</th>
                            <th class="text-right">Total price</th>
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
                                        <p class="mb-2">{{ $item->name }}</p>
                                        @foreach($item->attributes as $attribute)
                                            <span class="text-xs font-light text-gray-400">{{ $attribute }}</span>
                                        @endforeach
                                    </a>
                                </td>
                                <td class="justify-center md:justify-end md:flex mt-6">
                                    <div class="w-20 h-10">
                                        <div class="pr-8 flex ">
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
                <hr class="pb-6 mt-6">
                @guest
                    Total: {{ $totalPrice }}
                    <br>
                    <p>
                        <a class="font-medium" href="{{route('login')}}" >Se connecter</a> ou <a class="font-medium" href="{{route('login')}}" >S'inscrire</a>
                        pour valider la commande.
                    </p>
                @endguest
                @auth
                    <div class="my-4 mt-6 -mx-2 lg:flex">
                        <div class="lg:px-2 lg:w-1/2">
                            {{-- Coupon Code --}}
                            <div class="p-4 bg-gray-100 rounded-full">
                                <h1 class="ml-2 font-bold uppercase">Coupon Code</h1>
                            </div>
                            <div class="p-4">
                                <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
                                <div class="justify-center md:flex">
                                    <div class="flex items-center w-full h-13 pl-3 bg-white bg-gray-100 border rounded-full">
                                        <input type="coupon" name="code" id="coupon" placeholder="Apply coupon" value="90off"
                                               class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none"/>
                                        <button type="submit" class="text-sm flex items-center px-3 py-1 text-white bg-gray-800 rounded-full outline-none md:px-4 hover:bg-gray-700 focus:outline-none active:outline-none">
                                            <i class="far fa-lg fa-fw fa-gift"></i>
                                            <span class="font-medium">Apply coupon</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- Delivery address --}}
                            <div class="p-4 mt-6 bg-gray-100 rounded-full">
                                <h1 class="ml-2 font-bold uppercase">Delivery address</h1>
                            </div>
                            <div class="p-4">
                                {{-- todo form adress --}}
                            </div>
                        </div>
                        <div class="lg:px-2 lg:w-1/2">
                            <div class="p-4 bg-gray-100 rounded-full">
                                <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                            </div>
                            <div class="p-4">
                                <p class="mb-6 italic">Shipping costs are calculated based on values you have entered</p>
                                <div class="flex justify-between border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-bold text-center text-gray-800">Subtotal</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalPrice }}€</div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="flex lg:px-4 lg:py-2 m-2 text-lg font-semibold text-gray-800">
                                        <form action="" method="POST">
                                            <button type="submit" class="mr-2 mt-1 lg:mt-2">
                                                <svg aria-hidden="true" data-prefix="far" data-icon="trash-alt" class="w-4 text-red-600 hover:text-red-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M268 416h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12zM432 80h-82.41l-34-56.7A48 48 0 00274.41 0H173.59a48 48 0 00-41.16 23.3L98.41 80H16A16 16 0 000 96v16a16 16 0 0016 16h16v336a48 48 0 0048 48h288a48 48 0 0048-48V128h16a16 16 0 0016-16V96a16 16 0 00-16-16zM171.84 50.91A6 6 0 01177 48h94a6 6 0 015.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12z"/></svg>
                                            </button>
                                        </form>
                                        Coupon "90off"
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-700">
                                        -133,944.77€
                                    </div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Shipping</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">14,882.75€</div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Total</div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalPrice }}€</div>
                                </div>
                                <form method="post" action="{{ route('loja.payment.index') }}">
                            @csrf
                                    <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                        <i class="far fa-lg fa-fw fa-credit-card"></i>
                                        <span class="ml-2">Procceed to checkout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
