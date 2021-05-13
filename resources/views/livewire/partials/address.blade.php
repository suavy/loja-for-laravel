<div class="p-4 mt-6 bg-gray-100 rounded-full">
    <h1 class="ml-2 font-bold uppercase">Delivery address</h1>
</div>
<div class="p-4">

    <form wire:submit.prevent="saveAddress" method="post">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Prénom
                </label>
                <input wire:model="addressFirstname" class="@error('addressFirstname') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" >
                @error('addressFirstname')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Nom
                </label>
                <input wire:model="addressLastname" class="@error('addressLastname') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                @error('addressLastname')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Portable
                </label>
                <input wire:model="addressPhone" class="@error('addressPhone') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                @error('addressPhone')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Adresse
                </label>
                <input wire:model="addressStreet" class="@error('addressStreet') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text">
                @error('addressStreet')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Ville
                </label>
                <input wire:model="addressCity" class="@error('addressCity') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" >
                @error('addressCity')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Code postal
                </label>
                <input wire:model="addressZipCode" class="@error('addressZipCode') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" >
                @error('addressZipCode')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Pays
                </label>
                <select wire:model="addressCountry" class="@error('addressCountry') border-red-500 @enderror cursor-pointer appearance-none rounded border py-3 px-4  w-full leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="attributes.1">
                    <option></option>
                    @foreach($optionsCountries as $id => $country)
                        <option value="{{ $id }}">{{ $country }}</option>
                    @endforeach
                </select>
                @error('addressCountry')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Information complémentaire
                </label>
                <input wire:model="addressOther" class="@error('addressOther') border-red-500 @enderror appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="text">
                @error('addressOther')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>
        </div>

</div>
