<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Planes';
    protected static ?string $modelLabel = 'Plan';
    protected static ?string $pluralModelLabel = 'Planes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('discount_percentage')
                    ->label('Discount %')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100),
                Forms\Components\Toggle::make('is_popular')
                    ->required(),
                Forms\Components\TextInput::make('badge'),
                Forms\Components\TextInput::make('button_text')
                    ->required(),
                Forms\Components\TextInput::make('button_url'),
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
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('name')
                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                            ->size('lg')
                            ->searchable(),
                        Tables\Columns\IconColumn::make('is_popular')
                            ->boolean()
                            ->grow(false),
                    ]),
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('price')
                            ->formatStateUsing(fn($state) => '$' . number_format($state, 2))
                            ->weight(\Filament\Support\Enums\FontWeight::SemiBold)
                            ->size('xl')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('badge')
                            ->badge()
                            ->color('primary')
                            ->searchable(),
                    ]),
                    Tables\Columns\TextColumn::make('discount_percentage')
                        ->label('Discount')
                        ->formatStateUsing(fn($state) => $state ? "Discount: {$state}%" : null)
                        ->color('success')
                        ->sortable(),
                    Tables\Columns\TextColumn::make('button_text')
                        ->color('gray')
                        ->searchable(),
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
            RelationManagers\FeaturesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
