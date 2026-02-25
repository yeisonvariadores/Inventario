<flux:modal name="crear-usuario" class="max-w-2xl">
    <form wire:submit.prevent="crearUsuario">
        <div class="space-y-6">

            <flux:heading size="xl">
                Crear Usuario
            </flux:heading>

            <div class="grid grid-cols-1 gap-6">

                <flux:input
                    label="Nombre"
                    wire:model.defer="nombre"
                />
                @error('nombre') 
                    <span class="text-sm text-red-500">{{ $message }}</span> 
                @enderror

                <flux:input
                    type="email"
                    label="Correo"
                    wire:model.defer="correo"
                />
                @error('correo') 
                    <span class="text-sm text-red-500">{{ $message }}</span> 
                @enderror

                <flux:input
                    type="number"
                    label="DNI"
                    wire:model.defer="dni"
                />
                @error('dni') 
                    <span class="text-sm text-red-500">{{ $message }}</span> 
                @enderror

            </div>

            {{-- FOOTER --}}
            <div class="flex justify-end pt-4 gap-3">
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>

                <flux:button 
                    type="submit"
                    variant="primary"
                    color="blue"
                >
                    Crear Usuario
                </flux:button>
            </div>

        </div>
    </form>
</flux:modal>