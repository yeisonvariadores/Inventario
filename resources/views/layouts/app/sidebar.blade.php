<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')

        @livewireStyles

        {{-- Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="computer-desktop" :href="route('inventario.index')" :current="request()->routeIs('inventario.index')" wire:navigate>Inventario</flux:navlist.item>
                    <flux:navlist.item icon="users" :href="route('usuarios.index')" :current="request()->routeIs('usuarios.index')" wire:navigate>Usuarios</flux:navlist.item>
                    <flux:navlist.item icon="cpu-chip" :href="route('equipos.index')" :current="request()->routeIs('equipos.index')" wire:navigate>Equipos</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts

        @livewireScripts

        {{-- Scripts de componentes (Charts, etc) --}}
        @stack('scripts')


        {{-- Listener Livewire --}}
        <script>
            document.addEventListener('livewire:init', () => {

                // 🔵 Alertas normales (ya lo tienes)
                Livewire.on('swal', (data) => {
                    const alert = Array.isArray(data) ? data[0] : data;

                    Swal.fire({
                        icon: alert.icon,
                        title: alert.title,
                        text: alert.text,
                        confirmButtonText: 'OK',
                        zIndex: 99999
                    });
                });

                // 🟠 Alertas de CONFIRMACIÓN
                Livewire.on('swal-confirm', (data) => {
                    const alert = Array.isArray(data) ? data[0] : data;

                    Swal.fire({
                        title: alert.title ?? '¿Estás seguro?',
                        text: alert.text ?? '',
                        icon: alert.icon ?? 'warning',
                        showCancelButton: true,
                        confirmButtonText: alert.confirmButtonText ?? 'Confirmar',
                        cancelButtonText: alert.cancelButtonText ?? 'Cancelar',
                        reverseButtons: true,
                        zIndex: 99999
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.dispatch(alert.onConfirm ?? 'confirmar-actualizacion');
                        }
                    });
                });

            });
        </script>
    </body>
</html>
