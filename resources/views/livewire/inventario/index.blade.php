<div>

    {{-- Buscador --}}
    <div class="flex items-center justify-between mb-4">
            <div class="w-72">
                <flux:input wire:model.live.debounce.300ms="buscarAsignacion" icon="magnifying-glass"
                    placeholder="Buscar..." />
            </div>

            <flux:modal.trigger name="create-asignacion">
                <flux:button variant="primary" color="blue">
                    Asignar equipo
                </flux:button>
            </flux:modal.trigger>
        </div>

    <div class="rounded-xl border border-outline dark:border-outline-dark bg-surface dark:bg-surface-dark">
        <div class="overflow-x-auto rounded-xl">

            <table class="w-full text-left text-sm">
                <thead class="border-b bg-surface-alt dark:bg-surface-dark-alt">
                    <tr>
                        <th class="p-4" wire:click= "setSortBy('usuario')">
                            <x-sort.sort-button
                                field="usuario"
                                label="Usuarios"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('usuario')"
                            />
                        </th>

                        <th class="p-4 cursor-pointer" wire:click= "setSortBy('marca')">
                            <x-sort.sort-button
                                field="marca"
                                label="Marca"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('marca')"
                            />
                        </th>

                        <th class="p-4 cursor-pointer" wire:click= "setSortBy('modelo')">
                            <x-sort.sort-button
                                field="modelo"
                                label="Modelo"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('modelo')"
                            />
                        </th>

                        <th class="p-4 cursor-pointer" wire:click= "setSortBy('serial')">
                            <x-sort.sort-button
                                field="serial"
                                label="Serial"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('serial')"
                            />
                        </th>

                        <th class="p-4">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($asignaciones as $asignacion)

                    <tr>
                        <td class="p-4">
                            <div class="flex w-max items-center gap-2">
                                <flux:avatar :name="$asignacion->usuario->nombre" color="auto" />
                                <div class="flex flex-col">
                                    <span class="text-neutral-900 dark:text-white">{{ $asignacion->usuario->nombre }}</span>
                                    <span class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">{{ $asignacion->usuario->correo }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="p-4">
                            {{ $asignacion->equipo->marca }}
                        </td>

                        <td class="p-4">
                            {{ $asignacion->equipo->modelo }}
                        </td>

                        <td class="p-4">
                            {{ $asignacion->equipo->serial }}
                        </td>

                        <td class="p-4">
                            <flux:button
                                variant="ghost"
                                size="sm"
                                icon="eye"
                                wire:click="$dispatch('ver-asignacion', { id: {{ $asignacion->id }} })"
                            />
                        </td>
                    </tr>

                @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center">
                                No hay registros
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        {{-- Paginación --}}
        <div class="p-4">
            {{ $asignaciones->links() }}
        </div>

        @livewire('inventario.modalcreate')
        @livewire('inventario.ver-asignacion')
    </div>
</div>
