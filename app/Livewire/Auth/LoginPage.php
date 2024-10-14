<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Login')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:8|max:255',
        ]);

        if (!Auth::attempt($this->only('email', 'password'))) {
            session()->flash('error', 'Invalid login credentials');
            return;
        }

        // Redirect to the store page after successful login
        return redirect()->route('store');
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
