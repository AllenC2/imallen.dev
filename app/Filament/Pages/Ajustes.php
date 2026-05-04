<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Ajustes extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 100;

    protected static string $view = 'filament.pages.ajustes';
}
