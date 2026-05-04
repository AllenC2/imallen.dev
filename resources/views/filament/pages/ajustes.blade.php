<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-filament::section>
            <x-slot name="heading">
                Google Tag Manager
            </x-slot>
            <x-slot name="description">
                Configura la inyección de las etiquetas GTM en todas tus landing pages.
            </x-slot>

            <div class="mt-4 flex justify-end">
                <x-filament::button color="primary" tag="a" icon="heroicon-o-code-bracket"
                    href="{{ \App\Filament\Pages\TagManager::getUrl() }}">
                    Administrar Tag Manager
                </x-filament::button>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>