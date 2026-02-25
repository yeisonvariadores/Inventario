<flux:modal name="ver-asignacion" class="max-w-5xl">

    <div class="space-y-6">

        <flux:heading size="xl">
            Detalle de Asignación
        </flux:heading>

        @if ($usuario)
            <flux:heading size="lg">Usuario</flux:heading>
            {{-- GRID 3 COLUMNAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- 🧑 USUARIO --}}
                <div class="space-y-3">
                    <flux:input
                        label="Nombre"
                        :value="$usuario->nombre"
                        readonly
                    />
                </div>
                <div class="space-y-3">
                    <flux:input
                        label="DNI"
                        :value="$usuario->dni"
                        readonly
                    />
                </div>
                <div class="space-y-3">
                    <flux:input
                        label="Correo"
                        :value="$usuario->correo"
                        readonly
                    />
                </div>
            </div>
            <flux:spacer />
            <flux:heading size="lg">Equipo</flux:heading>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <flux:input
                        label="Activo Fijo"
                        :value="$asignacion?->equipo?->activo_fijo"
                        readonly
                    />
                </div>

                {{-- 💻 EQUIPO --}}
                <div class="space-y-3">
                    <flux:input
                        label="Marca"
                        :value="$asignacion?->equipo?->marca"
                        readonly
                    />
                </div>
                <div class="space-y-3">
                    <flux:input
                        label="Modelo"
                        :value="$asignacion?->equipo?->modelo"
                        readonly
                    />
                </div>
                <div class="space-y-3">
                    <flux:input
                        label="Serial"
                        :value="$asignacion?->equipo?->serial"
                        readonly
                    />
                </div>    
                <div class="space-y-3">
                    <flux:input
                        label="Estado"
                        value="Asignado"
                        readonly
                    />
                </div>
                <div class="space-y-3">
                    <flux:input
                        label="Fecha de asignación"
                        :value="$asignacion?->fecha_asignacion"
                        readonly
                    />
                </div>
            </div>
        @else
            <p class="text-sm text-gray-500">
                No hay información para mostrar.
            </p>
        @endif

        {{-- FOOTER --}}
        <div class="flex justify-end pt-4">
            <flux:modal.close>
                <flux:button variant="ghost">
                    Cancelar
                </flux:button>
            </flux:modal.close>
            
            <flux:button variant="primary" color="blue" wire:click="confirmarDesasignacion">
                Desasignar
            </flux:button>
        </div>

    </div>

</flux:modal>