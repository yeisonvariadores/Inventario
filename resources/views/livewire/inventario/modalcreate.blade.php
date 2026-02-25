<flux:modal name="create-asignacion" class="md:w-96">
    <div class="space-y-6">

        <div>
            <flux:heading size="lg">Asignar equipo</flux:heading>
            <flux:text class="mt-2">
                Selecciona usuario y equipo disponible.
            </flux:text>
        </div>

        {{-- Usuario --}}
        <div x-data="{
            open: false,
            search: '',
            usuarios: @js($usuarios),
            get filtered() {
                let term = this.search.toLowerCase()

                return this.usuarios.filter(u =>
                    (u.nombre && u.nombre.toLowerCase().includes(term)) ||
                    (u.dni && u.dni.toLowerCase().includes(term))
                )
            }
        }" class="relative">

            <label class="block text-sm font-medium mb-1">
                Usuario
            </label>

            <input type="text" x-model="search" @focus="open = true" @click.away="open = false"
                placeholder="Buscar usuario..." class="w-full border rounded-lg p-2">

            @error('usuario_id')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

            <div x-show="open"
                class="absolute z-50 w-full bg-white border rounded-lg mt-1 max-h-48 overflow-y-auto shadow-lg">
                <template x-for="usuario in filtered" :key="usuario.id">
                    <div @click="
                    search = usuario.nombre;
                    open = false;
                    $wire.set('usuario_id', usuario.id);
                "
                        class="p-2 hover:bg-gray-100 cursor-pointer">
                        <span x-text="usuario.nombre + ' - ' + usuario.dni"></span>
                    </div>
                </template>

                <div x-show="filtered.length === 0" class="p-2 text-gray-500">
                    No se encontraron resultados
                </div>
            </div>

        </div>

        {{-- Equipo disponible --}}
        <div x-data="{
            open: false,
            search: '',
            equipos: @js($equiposDisponibles),
            get filtered() {
            let term = this.search.toLowerCase()

            return this.equipos.filter(e =>
                (e.serial && e.serial.toLowerCase().includes(term)) ||
                (e.activo_fijo && e.activo_fijo.toLowerCase().includes(term))
            )
        }
        }" class="relative">

            <label class="block text-sm font-medium mb-1">
                Equipo
            </label>

            <input type="text" x-model="search" @focus="open = true" @click.away="open = false"
                placeholder="Buscar equipo..." class="w-full border rounded-lg p-2">

            @error('equipo_id')
                <span class="text-red-500 text-sm">
                    {{ $message }}
                </span>
            @enderror

            <div x-show="open"
                class="absolute z-50 w-full bg-white border rounded-lg mt-1 max-h-48 overflow-y-auto shadow-lg">
                <template x-for="equipo in filtered" :key="equipo.id">
                    <div @click="
                    search = equipo.marca + ' - ' + equipo.modelo + ' - ' + equipo.serial;
                    open = false;
                    $wire.set('equipo_id', equipo.id);
                "
                        class="p-2 hover:bg-gray-100 cursor-pointer">
                        <span x-text="equipo.serial + ' - ' + equipo.activo_fijo"></span>
                    </div>
                </template>

                <div x-show="filtered.length === 0" class="p-2 text-gray-500">
                    No se encontraron resultados
                </div>
            </div>

        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">
                    Cancelar
                </flux:button>
            </flux:modal.close>

            <flux:button variant="primary" color="blue" wire:click="guardarAsignacion">
                Guardar
            </flux:button>
        </div>

    </div>
</flux:modal>
