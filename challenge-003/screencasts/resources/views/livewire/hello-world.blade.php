<div>
    @foreach ($contacts as $contact)
        <livewire:say-hi :$contact :key="$contact->id" />

        <button wire:click="removeContact('{{ $contact->name }}')">Remove</button>
    @endforeach

    <hr>

    <button wire:click="$refresh">refresh</button>

    {{ now() }}
</div>
