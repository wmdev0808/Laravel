<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="#" wire:submit.prevent="$set('name','Bingo')">
            {{-- <input wire:model="name" type="text"> --}}
            {{-- <input wire:model.live.debounce.1000ms="name" type="text"> --}}
            {{-- <input wire:model.blur="name" type="text"> --}}
            <div>
                <input wire:model.live="name" type="text">
            </div>
            <div>
                <label for="loud" class="block text-sm font-medium leading-6 text-gray-900">Loud?</label>
                <input wire:model.live="loud" type="checkbox" name="loud" id="loud">

            </div>

            <div>
                <select wire:model.live="greeting" multiple class="px-4 py-3">
                    <option>Hello</option>
                    <option>Goodbye</option>
                    <option>Adios</option>
                </select>
            </div>

            <div>
                {{ implode(', ', $greeting) }} {{ $name }} @if ($loud)
                    !
                @endif
            </div>

            {{-- <button
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                wire:click="resetName('Bingo')">Reset
                Name</button> --}}
            {{-- <button
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                wire:click="resetName($event.target.innerText)">Reset
                Name</button> --}}

            <button
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reset
                Name</button>
        </form>

    </div>

</div>
