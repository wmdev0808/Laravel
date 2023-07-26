<?php

namespace App\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public $name = 'Paul';

    public $loud = false;

    public $greeting = ['Hello'];

    public function render()
    {
        return view('livewire.hello-world');
    }
}
