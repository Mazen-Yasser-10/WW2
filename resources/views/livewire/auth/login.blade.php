<?php

use App\Models\User;
use App\Models\Country;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $country_id = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function with(): array
    {
        return [
            'countries' => Country::orderBy('name')->get(),
        ];
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'country_id' => ['required', 'exists:countries,id'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('weapons.index', absolute: false), navigate: true);
    }
}; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Instrument Sans', sans-serif !important;
        background-image: url('https://i.ibb.co/0jKmKB0R/premium-photo-1661901234139-d833950e05e0.jpg') !important;
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        color: #fff !important;
        transition: background 0.3s, color 0.3s !important;
        margin: 0 !important;
        padding: 0 !important;
        min-height: 100vh !important;
    }

    /* Ensure form elements are readable */
    .register-container {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 12px;
        padding: 2rem;
        backdrop-filter: blur(10px);
    }
</style>

<div class="flex justify-center items-center min-h-screen">
    <div class="register-container w-full max-w-md">
        <div class="flex flex-col gap-6">
            <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit="register" class="flex flex-col gap-6">
                <!-- Name -->
                <flux:input
                    wire:model="name"
                    :label="__('Name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                />

                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email address')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                <!-- Country -->
                <flux:select
                    wire:model="country_id"
                    :label="__('Country')"
                    placeholder="Select your country"
                    required
                >
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </flux:select>

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('Create account') }}
                    </flux:button>
                </div>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-300">
                <span>{{ __('Already have an account?') }}</span>
                <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
            </div>
        </div>
    </div>
</div>
