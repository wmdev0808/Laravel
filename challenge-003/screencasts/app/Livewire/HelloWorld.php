<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class HelloWorld extends Component
{
    public $name = 'Paul';

    public $hydratedName;

    // public function mount(Request $request, $name)
    // {
    //     $this->name = $request->input('name', $name);
    // }

    public function mount($name)
    {
        $this->name = $name;
    }

    public function hydrate()
    {
        $this->hydratedName = 'hydrated';
    }

    public function updating()
    {
    }

    // public function updated()
    // {
    //     $this->name = strtoupper($this->name);
    // }

    // public function updated($name)
    // {
    //     $this->name = strtoupper($name);
    // }

    /**
     * Because you are often targeting a specific property when using update hooks, Livewire allows you to specify the property name directly as part of the method name.
     */
    public function updatedName($name)
    {
        $this->name = strtoupper($name);
    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
