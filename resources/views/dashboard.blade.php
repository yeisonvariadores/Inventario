<div class="min-h-screen w-full">
    <div class="flex min-h-screen w-full flex-col gap-4 p-4">

        <!-- GRID SUPERIOR -->
        <div class="grid gap-4 md:grid-cols-3">

            <!-- CARD 1 -->
            <div class="relative h-56 md:h-90 lg:h-80 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <livewire:charts.equipos-chart 
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" 
                />
            </div>

            <!-- CARD 2 -->
            <div class="relative h-56 md:h-64 lg:h-80 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <livewire:charts.equiposCiudad-chart
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" 
                />
            </div>

            <!-- CARD 3 -->
            <div class="relative h-56 md:h-64 lg:h-80 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <livewire:charts.vida-util-chart 
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" 
                />
            </div>

        </div>

        <!-- BLOQUE INFERIOR (CRECE AUTOMÁTICAMENTE) -->
        <div class="relative h-[430px] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:charts.asignaciones-mensuales-chart
                class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" 
            />
        </div>

    </div>
</div>