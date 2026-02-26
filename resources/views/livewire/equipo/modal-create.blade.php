<flux:modal name="create-equipo" class="max-w-2xl">
    <form wire:submit.prevent="crearEquipo">
        <div class="space-y-6">
            <flux:heading size="xl">
                Crear Equipo
            </flux:heading>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <flux:input label="Activo Fijo" wire:model.live="activo_fijo"
                        :error="$errors->first('activo_fijo')" />
                </div>
                <div class="space-y-3">
                    <flux:input label="Marca" wire:model.defer="marca" :error="$errors->first('marca')" />
                </div>
                <div class="space-y-3">
                    <flux:input label="Modelo" wire:model.defer="modelo" :error="$errors->first('modelo')" />
                </div>
                <div class="space-y-3">
                    <flux:input label="Serial" wire:model.live="serial" :error="$errors->first('serial')" />
                </div>
                <div class="space-y-3">
                    <flux:input label="Almacenamiento (GB)" wire:model.live="almacenamiento"
                        :error="$errors->first('almacenamiento')" />
                </div>
                <div class="space-y-3">
                    <flux:input label="RAM (GB)" wire:model.live="ram" :error="$errors->first('ram')" />
                </div>
                <div class="space-y-3">
                    <flux:select label="Sistema Operativo" wire:model.defer="sistema_operativo"
                        :error="$errors->first('sistema_operativo')">
                        <flux:select.option value="">-- Seleccione sistema operativo --</flux:select.option>
                        <flux:select.option value="Windows 10 Pro">Windows 10 Pro</flux:select.option>
                        <flux:select.option value="Windows 11 Pro">Windows 11 Pro</flux:select.option>
                        <flux:select.option value="macOS">macOS</flux:select.option>
                    </flux:select>
                </div>
                <div class="space-y-3">
                    <flux:select label="Ciudad" wire:model.live="ciudad_id" :error="$errors->first('ciudad_id')">
                        <flux:select.option value="">-- Seleccione ciudad --</flux:select.option>
                        @foreach ($ciudades as $ciudad)
                            <flux:select.option value="{{ $ciudad->id }}">
                                {{ $ciudad->nombre }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="flex justify-end pt-4 gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary" color="blue">
                    Crear equipo
                </flux:button>
            </div>
        </div>
    </form>
</flux:modal>
