<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Setting;
use Filament\Notifications\Notification;

class TagManager extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.tag-manager';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'gtm_id' => Setting::val('gtm_id', 'GTM-5FS5DVB2'),
            'is_gtm_active' => Setting::val('is_gtm_active', '0') === '1',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('gtm_id')
                    ->label('Google Tag Manager ID')
                    ->placeholder('Ej. GTM-XXXXXXX')
                    ->required(),
                Toggle::make('is_gtm_active')
                    ->label('Activar Google Tag Manager')
                    ->helperText('Habilita o deshabilita la inyección de GTM en todas las landing pages.'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        Setting::updateOrCreate(['key' => 'gtm_id'], ['value' => $data['gtm_id']]);
        Setting::updateOrCreate(['key' => 'is_gtm_active'], ['value' => $data['is_gtm_active'] ? '1' : '0']);

        Notification::make()
            ->title('Guardado')
            ->body('La configuración de Tag Manager ha sido actualizada.')
            ->success()
            ->send();
    }
}
