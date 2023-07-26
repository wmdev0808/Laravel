<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class SayHi extends Component
{
    public $contact;

    #[On('refresh-children')]
    public function refreshChildren()
    {
    }

    protected $listeners = ['foo' => '$refresh'];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.say-hi');
    }
}
