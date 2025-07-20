<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-900">
        <flux:sidebar sticky stashable class="border-e border-gray-700 bg-gray-800 shadow-2xl">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('weapons.index') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse mb-6 pb-4 border-b border-gray-700" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline" class="text-gray-300">
                <flux:navlist.group :heading="__('🏛️ Command Center')" class="grid text-gray-200">
                    <flux:navlist.item :href="route('weapons.index')" :current="request()->routeIs('weapons.*')" wire:navigate class="text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">{{ __('⚔️ Arsenal') }}</flux:navlist.item>
                    <flux:navlist.item :href="route('cart.index')" :current="request()->routeIs('cart.*')" wire:navigate class="text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">{{ __('🛒 Supplies') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline" class="text-gray-300">
                <flux:navlist.group :heading="__('🎖️ Military Operations')" class="grid text-gray-200">
                    <!-- Add more navigation items here -->
                    <flux:navlist.item :href="route('orders.index')" :current="request()->routeIs('orders.*')" wire:navigate class="text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">{{ __('📋 Operations') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
            @include('components.cash-balance')

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    class="text-white hover:bg-gray-700 transition-colors duration-200"
                />

                <flux:menu class="w-[220px] bg-gray-800 border border-gray-700 shadow-2xl">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-gray-700 text-white border border-gray-600"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-white">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-gray-400">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-gray-700" />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">{{ __('⚙️ Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-gray-700" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-400 hover:text-red-300 hover:bg-gray-700 transition-colors duration-200">
                            {{ __('🚪 Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden bg-gray-800 border-b border-gray-700">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                    class="text-white hover:bg-gray-700 transition-colors duration-200"
                />

                <flux:menu class="bg-gray-800 border border-gray-700 shadow-2xl">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-gray-700 text-white border border-gray-600"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-white">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-gray-400">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-gray-700" />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate class="text-gray-300 hover:text-white hover:bg-gray-700 transition-colors duration-200">{{ __('⚙️ Settings') }}</flux:menu.item>

                    </flux:menu.radio.group>

                    <flux:menu.separator class="border-gray-700" />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-400 hover:text-red-300 hover:bg-gray-700 transition-colors duration-200">
                            {{ __('🚪 Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        @livewireScripts
    </body>
</html>
