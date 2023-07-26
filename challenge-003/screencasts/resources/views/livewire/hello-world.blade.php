<div>
    @foreach ($contacts as $contact)
        <livewire:say-hi :$contact :key="$contact->id" />

        <button wire:click="removeContact('{{ $contact->name }}')">Remove</button>
    @endforeach

    <hr>

    {{-- <button wire:click="refreshChildren"
        class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Refresh
        Children</button> --}}

    <button wire:click="$dispatch('refresh-children')"
        class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Refresh
        Children</button>

    {{ now() }}
</div>
