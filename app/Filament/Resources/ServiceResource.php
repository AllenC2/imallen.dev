<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Servicios';
    protected static ?string $modelLabel = 'Servicio';
    protected static ?string $pluralModelLabel = 'Servicios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('icon')
                    ->label(fn() => new \Illuminate\Support\HtmlString('Icono <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">'))
                    ->options([
                        'fa-solid fa-code' => '<i class="fa-solid fa-code fa-fw"></i> Código',
                        'fa-solid fa-mobile-screen-button' => '<i class="fa-solid fa-mobile-screen-button fa-fw"></i> Móvil',
                        'fa-solid fa-cloud' => '<i class="fa-solid fa-cloud fa-fw"></i> Cloud',
                        'fa-solid fa-robot' => '<i class="fa-solid fa-robot fa-fw"></i> Inteligencia Artificial',
                        'fa-solid fa-globe' => '<i class="fa-solid fa-globe fa-fw"></i> Sitio Web',
                        'fa-solid fa-server' => '<i class="fa-solid fa-server fa-fw"></i> Servidor',
                        'fa-solid fa-database' => '<i class="fa-solid fa-database fa-fw"></i> Base de Datos',
                        'fa-solid fa-shield-halved' => '<i class="fa-solid fa-shield-halved fa-fw"></i> Seguridad',
                        'fa-solid fa-chart-line' => '<i class="fa-solid fa-chart-line fa-fw"></i> Analítica',
                        'fa-solid fa-magnifying-glass' => '<i class="fa-solid fa-magnifying-glass fa-fw"></i> SEO / Búsqueda',
                        'fa-solid fa-pen-nib' => '<i class="fa-solid fa-pen-nib fa-fw"></i> Diseño UI/UX',
                        'fa-solid fa-bullhorn' => '<i class="fa-solid fa-bullhorn fa-fw"></i> Marketing',
                        'fa-solid fa-cart-shopping' => '<i class="fa-solid fa-cart-shopping fa-fw"></i> E-commerce',
                        'fa-solid fa-envelope' => '<i class="fa-solid fa-envelope fa-fw"></i> Email / Contacto',
                        'fa-solid fa-users' => '<i class="fa-solid fa-users fa-fw"></i> Equipo / Usuarios',
                        'fa-solid fa-briefcase' => '<i class="fa-solid fa-briefcase fa-fw"></i> Negocio B2B',
                        'fa-solid fa-truck' => '<i class="fa-solid fa-truck fa-fw"></i> Logística',
                        'fa-solid fa-building' => '<i class="fa-solid fa-building fa-fw"></i> Empresa',
                        'fa-solid fa-gamepad' => '<i class="fa-solid fa-gamepad fa-fw"></i> Juegos',
                        'fa-solid fa-video' => '<i class="fa-solid fa-video fa-fw"></i> Video',
                    ])
                    ->allowHtml()
                    ->searchable()
                    ->columnSpanFull(),
                Forms\Components\Select::make('color_class')
                    ->label('Color "Glow"')
                    ->options([
                        'hover-glow-purple' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#9c27b0; margin-right:8px; box-shadow: 0 0 8px #9c27b0;"></span> Morado Glow',
                        'hover-glow-orange' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#ff9800; margin-right:8px; box-shadow: 0 0 8px #ff9800;"></span> Naranja Glow',
                        'hover-glow-blue' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#2196f3; margin-right:8px; box-shadow: 0 0 8px #2196f3;"></span> Azul Glow',
                        'hover-glow-green' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#4caf50; margin-right:8px; box-shadow: 0 0 8px #4caf50;"></span> Verde Glow',
                        'hover-glow-red' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#f44336; margin-right:8px; box-shadow: 0 0 8px #f44336;"></span> Rojo Glow',
                        'hover-glow-yellow' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#ffeb3b; margin-right:8px; box-shadow: 0 0 8px #ffeb3b;"></span> Amarillo Glow',
                        'hover-glow-pink' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#e91e63; margin-right:8px; box-shadow: 0 0 8px #e91e63;"></span> Rosa Glow',
                        'hover-glow-cyan' => '<span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:#00bcd4; margin-right:8px; box-shadow: 0 0 8px #00bcd4;"></span> Cyan Glow',
                    ])
                    ->allowHtml()
                    ->live()
                    ->prefix(function (\Filament\Forms\Get $get) {
                        $colors = [
                            'hover-glow-purple' => '#9c27b0',
                            'hover-glow-orange' => '#ff9800',
                            'hover-glow-blue' => '#2196f3',
                            'hover-glow-green' => '#4caf50',
                            'hover-glow-red' => '#f44336',
                            'hover-glow-yellow' => '#ffeb3b',
                            'hover-glow-pink' => '#e91e63',
                            'hover-glow-cyan' => '#00bcd4',
                        ];
                        $val = $get('color_class');
                        if (!$val || !isset($colors[$val])) {
                            return null;
                        }
                        return new \Illuminate\Support\HtmlString('<div style="display: flex; align-items: center; justify-content: center;"><span style="display:inline-block; width:16px; height:16px; border-radius:50%; background-color:' . $colors[$val] . '; box-shadow: 0 0 8px ' . $colors[$val] . ';"></span></div>');
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('title')
                        ->weight(\Filament\Support\Enums\FontWeight::Bold)
                        ->size('lg')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('description')
                        ->color('gray')
                        ->limit(150)
                        ->wrap()
                        ->searchable(),
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('icon')
                            ->formatStateUsing(function (string $state) {
                                $icons = [
                                    'fa-solid fa-code' => '<i class="fa-solid fa-code fa-fw"></i> Código',
                                    'fa-solid fa-mobile-screen-button' => '<i class="fa-solid fa-mobile-screen-button fa-fw"></i> Móvil',
                                    'fa-solid fa-cloud' => '<i class="fa-solid fa-cloud fa-fw"></i> Cloud',
                                    'fa-solid fa-robot' => '<i class="fa-solid fa-robot fa-fw"></i> Inteligencia Artificial',
                                    'fa-solid fa-globe' => '<i class="fa-solid fa-globe fa-fw"></i> Sitio Web',
                                    'fa-solid fa-server' => '<i class="fa-solid fa-server fa-fw"></i> Servidor',
                                    'fa-solid fa-database' => '<i class="fa-solid fa-database fa-fw"></i> Base de Datos',
                                    'fa-solid fa-shield-halved' => '<i class="fa-solid fa-shield-halved fa-fw"></i> Seguridad',
                                    'fa-solid fa-chart-line' => '<i class="fa-solid fa-chart-line fa-fw"></i> Analítica',
                                    'fa-solid fa-magnifying-glass' => '<i class="fa-solid fa-magnifying-glass fa-fw"></i> SEO / Búsqueda',
                                    'fa-solid fa-pen-nib' => '<i class="fa-solid fa-pen-nib fa-fw"></i> Diseño UI/UX',
                                    'fa-solid fa-bullhorn' => '<i class="fa-solid fa-bullhorn fa-fw"></i> Marketing',
                                    'fa-solid fa-cart-shopping' => '<i class="fa-solid fa-cart-shopping fa-fw"></i> E-commerce',
                                    'fa-solid fa-envelope' => '<i class="fa-solid fa-envelope fa-fw"></i> Email / Contacto',
                                    'fa-solid fa-users' => '<i class="fa-solid fa-users fa-fw"></i> Equipo / Usuarios',
                                    'fa-solid fa-briefcase' => '<i class="fa-solid fa-briefcase fa-fw"></i> Negocio B2B',
                                    'fa-solid fa-truck' => '<i class="fa-solid fa-truck fa-fw"></i> Logística',
                                    'fa-solid fa-building' => '<i class="fa-solid fa-building fa-fw"></i> Empresa',
                                    'fa-solid fa-gamepad' => '<i class="fa-solid fa-gamepad fa-fw"></i> Juegos',
                                    'fa-solid fa-video' => '<i class="fa-solid fa-video fa-fw"></i> Video',
                                ];
                                $html = $icons[$state] ?? $state;
                                return new \Illuminate\Support\HtmlString('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">' . $html);
                            })
                            ->searchable(),
                        Tables\Columns\TextColumn::make('color_class')
                            ->formatStateUsing(function (string $state) {
                                $colors = [
                                    'hover-glow-purple' => '#9c27b0',
                                    'hover-glow-orange' => '#ff9800',
                                    'hover-glow-blue' => '#2196f3',
                                    'hover-glow-green' => '#4caf50',
                                    'hover-glow-red' => '#f44336',
                                    'hover-glow-yellow' => '#ffeb3b',
                                    'hover-glow-pink' => '#e91e63',
                                    'hover-glow-cyan' => '#00bcd4',
                                ];
                                $colorLabels = [
                                    'hover-glow-purple' => 'Morado Glow',
                                    'hover-glow-orange' => 'Naranja Glow',
                                    'hover-glow-blue' => 'Azul Glow',
                                    'hover-glow-green' => 'Verde Glow',
                                    'hover-glow-red' => 'Rojo Glow',
                                    'hover-glow-yellow' => 'Amarillo Glow',
                                    'hover-glow-pink' => 'Rosa Glow',
                                    'hover-glow-cyan' => 'Cyan Glow',
                                ];
                                $colorHex = $colors[$state] ?? 'gray';
                                $label = $colorLabels[$state] ?? $state;
                                return new \Illuminate\Support\HtmlString('<div style="display:flex; align-items:center;"><span style="display:inline-block; width:12px; height:12px; border-radius:50%; background-color:' . $colorHex . '; box-shadow: 0 0 8px ' . $colorHex . '; margin-right:8px;"></span> ' . $label . '</div>');
                            })
                            ->searchable()
                            ->alignEnd(),
                    ]),
                ])->space(3),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
