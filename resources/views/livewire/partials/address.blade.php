<div class="p-1">
    <form wire:submit.prevent="saveAddress" method="post">

        <div class="flex flex-wrap">
            <div class="w-1/2 md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.firstname')
                </label>
                <input wire:model="addressFirstname" class="@error('addressFirstname') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" >
                @error('addressFirstname')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
            <div class="w-1/2 md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.lastname')
                </label>
                <input wire:model="addressLastname" class="@error('addressLastname') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                @error('addressLastname')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.phone')
                </label>
                <input wire:model="addressPhone" class="@error('addressPhone') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                @error('addressPhone')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.address')
                </label>
                <input wire:model="addressStreet" class="@error('addressStreet') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text">
                @error('addressStreet')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-1/2 md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.postal-code')
                </label>
                <input wire:model="addressZipCode" class="@error('addressZipCode') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" >
                @error('addressZipCode')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
            <div class="w-1/2 md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.city')
                </label>
                <input wire:model="addressCity" class="@error('addressCity') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" >
                @error('addressCity')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.country')
                </label>
                <select wire:model="addressCountry" class="@error('addressCountry') border-red-500 @enderror cursor-pointer appearance-none rounded border py-3 px-4  w-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="attributes.1">
                    <option></option>
                    @foreach($optionsCountries as $id => $country)
                        <option value="{{ $id }}">{{ $country }}</option>
                    @endforeach
                </select>
                @error('addressCountry')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full p-3">
                <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2">
                    @lang('loja::cart.address.labels.additional-informations')
                </label>
                <textarea wire:model="addressOther" class="@error('addressOther') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password"></textarea>
                @error('addressOther')<p class="text-red-500 text-xs italic pt-1">{{ $message }}</p>@enderror
            </div>
        </div>

</div>
