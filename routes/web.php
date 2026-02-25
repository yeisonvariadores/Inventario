<?php

use App\Livewire\Inventario\InventarioIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\Equipo\EquipoIndex;
use App\Livewire\Usuario\UsuarioIndex;
use App\Livewire\Dashboard;


Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
        //Ruta protegida de Inventario.
        
        Route::get('/inventario', InventarioIndex::class)->name('inventario.index');
        Route::get('/usuarios', UsuarioIndex::class)->name('usuarios.index');

        Route::get('/equipos', EquipoIndex::class)->name('equipos.index');
});

