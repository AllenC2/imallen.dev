<?php

namespace App\Filament\Resources\ExpedienteResource\RelationManagers;

use App\Enums\TipoMovimientoEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MovimientosRelationManager extends RelationManager
{
    protected static string $relationship = 'movimientos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo')
                    ->label('Tipo')
                    ->options(collect(TipoMovimientoEnum::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                    ->default(TipoMovimientoEnum::Cargo->value)
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('monto')
                    ->label('Monto')
                    ->numeric()
                    ->inputMode('decimal')
                    ->step(0.01)
                    ->minValue(0.01)
                    ->required(),
                Forms\Components\DatePicker::make('fecha')
                    ->label('Fecha')
                    ->default(now())
                    ->required(),
                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->nullable()
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('tipo')
            ->defaultSort('fecha', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn ($state): string => $state instanceof TipoMovimientoEnum ? $state->color() : 'gray')
                    ->formatStateUsing(fn ($state): string => $state instanceof TipoMovimientoEnum ? $state->label() : (string) $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\TextColumn::make('monto')
                    ->label('Monto')
                    ->formatStateUsing(function ($state, $record) {
                        $sign = $record->tipo instanceof TipoMovimientoEnum ? $record->tipo->sign() : 1;
                        $prefix = $sign > 0 ? '+' : '-';

                        return $prefix.number_format((float) $state, 2);
                    })
                    ->color(fn ($record): string => $record->tipo instanceof TipoMovimientoEnum && $record->tipo === TipoMovimientoEnum::Pago ? 'success' : 'danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
