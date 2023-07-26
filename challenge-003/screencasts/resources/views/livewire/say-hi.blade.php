<div>
    <input type="text" wire:model.live="name">

    Hello {{ $contact->name }} : {{ now() }}

    <button wire:click="$refresh">refresh</button>
</div>
