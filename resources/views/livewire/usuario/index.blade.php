<div>

    {{-- Buscador --}}
    <div class="flex items-center justify-between mb-4">
            <div class="w-72">
                <flux:input wire:model.live.debounce.300ms="buscarUsuario" icon="magnifying-glass"
                    placeholder="Buscar usuario..." />
            </div>

            <flux:modal.trigger name="crear-usuario">
                <flux:button variant="primary" color="blue" >
                    Crear Usuario
                </flux:button>
            </flux:modal.trigger>
        </div>

    <div class="rounded-xl border border-outline dark:border-outline-dark bg-surface dark:bg-surface-dark">
        <div class="overflow-x-auto rounded-xl">

            <table class="w-full text-left text-sm">
                <thead class="border-b bg-surface-alt dark:bg-surface-dark-alt">
                    <tr>
                        <th class="p-4 cursor-pointer" wire:click= "setSortBy('nombre')">
                            <x-sort.sort-button
                                field="nombre"
                                label="Nombre"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('nombre')"
                            />
                        </th>

                        <th class="p-4 cursor-pointer"  wire:click= "setSortBy('correo')">
                            <x-sort.sort-button
                                field="correo"
                                label="Correo"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('correo')"
                            />
                        </th>

                        <th class="p-4 cursor-pointer"  wire:click= "setSortBy('dni')">
                            <x-sort.sort-button
                                field="dni"
                                label="DNI"
                                :$sortBy
                                :$sortDirection
                                wire:click="setSortBy('dni')"
                            />
                        </th>

                        <th class="p-4">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    {{ $usuario->id }}
                                    <flux:avatar icon="user" color="blue" />

                                    <div class="font-medium">
                                        {{ $usuario->nombre }}
                                    </div>
                                </div>
                            </td>

                            <td class="p-4">
                                {{ $usuario->correo }}
                            </td>

                            <td class="p-4">
                                {{ $usuario->dni }}
                            </td>

                            <td class="p-4">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                    wire:click="verUsuario({{ $usuario->id }})"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center">
                                No hay usuarios registrados
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        {{-- Paginación --}}
        <div class="p-4">
            {{ $usuarios->links() }}
        </div>

        @livewire('usuario.modalcreate')
    </div>
</div>

