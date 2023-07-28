<?php

namespace App\Livewire\Auth\Passwords;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Confirm your password')]
class Confirm extends Component
{
    /** @var string */
    public $password = '';

    public function confirm()
    {
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm')
            ->extends('components.layouts.auth');
    }
}
