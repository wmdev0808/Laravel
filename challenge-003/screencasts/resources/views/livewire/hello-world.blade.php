<div>
    {{-- <input wire:model="name" type="text"> --}}
    {{-- <input wire:model.live.debounce.1000ms="name" type="text"> --}}
    {{-- <input wire:model.blur="name" type="text"> --}}
    <input wire:model.live="name" type="text">
    <input wire:model.live="loud" type="checkbox">
    <select wire:model.live="greeting" multiple>
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Adios</option>
    </select>

    {{ implode(', ', $greeting) }} {{ $name }} @if ($loud)
        !
    @endif

    <button wire:click="resetName">Reset Name</button>
</div>
