<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Proyectos';
    protected static ?string $modelLabel = 'Proyecto';
    protected static ?string $pluralModelLabel = 'Proyectos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('technologies')
                    ->label('Tecnologías')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Tecnología')
                            ->required(),
                    ])
                    ->dehydrateStateUsing(fn ($state) => array_map(fn ($item) => $item['value'] ?? '', $state ?? []))
                    ->addActionLabel('Agregar tecnología')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('images')
                    ->label('Imágenes (arrastra para reordenar)')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->directory('projects')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('links')
                    ->label('Enlaces')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'website' => 'Sitio Web',
                                'github' => 'GitHub',
                                'demo' => 'Demo',
                                'figma' => 'Figma',
                                'npm' => 'NPM',
                                'other' => 'Otro',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->required(),
                    ])
                    ->addActionLabel('Agregar enlace')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
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
                    Tables\Columns\TextColumn::make('name')
                        ->weight(\Filament\Support\Enums\FontWeight::Bold)
                        ->size('lg')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('description')
                        ->color('gray')
                        ->limit(150)
                        ->wrap()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('technologies')
                        ->formatStateUsing(function ($state) {
                            if (!is_array($state)) {
                                return $state;
                            }
                            return collect($state)->map(fn($tech) => "<span class='inline-block bg-gray-700 text-gray-200 text-xs px-2 py-1 rounded mr-1 mb-1'>{$tech}</span>")->implode('');
                        })
                        ->html()
                        ->wrap(),
                    Tables\Columns\TextColumn::make('sort_order')
                        ->label('Orden')
                        ->sortable()
                        ->alignEnd(),
                ])->space(3),
            ])
            ->defaultSort('sort_order')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
