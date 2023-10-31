<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(['required', 'max:255'])]
    public ?string $name;

    #[Rule(['required', 'email', 'confirmed'])]
    public ?string $email;

    #[Rule(['required'])]
    public ?string $email_confirmation;

    #[Rule(['required'])]
    public ?string $password;

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME);
    }

    public function render(): View
    {
        return view('livewire.auth.register')
        ->layout('components.layouts.guest');
    }
}
