<?php

namespace App\Filament\Resources;

use App\Enums\TipoUsuarioEnum;
use App\Filament\Resources\ExpedienteResource\Pages;
use App\Filament\Resources\ExpedienteResource\RelationManagers;
use App\Models\Expediente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpedienteResource extends Resource
{
    protected static ?string $model = Expediente::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Expedientes';

    protected static ?string $modelLabel = 'Expediente';

    protected static ?string $pluralModelLabel = 'Expedientes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Balance del Expediente')
                    ->description(fn ($record) => $record ? 'Resumen de ingresos y cargos registrados' : null)
                    ->schema([
                        Forms\Components\Placeholder::make('saldo_display')
                            ->label('Saldo actual')
                            ->content(function ($record): ?\Illuminate\Support\HtmlString {
                                if (! $record) {
                                    return new \Illuminate\Support\HtmlString('<span style="color:#86868b">Disponible al editar</span>');
                                }
                                $saldo = $record->saldo;
                                $color = $saldo > 0 ? '#34c759' : ($saldo < 0 ? '#ff3b30' : '#86868b');
                                $prefix = $saldo > 0 ? '+' : '';

                                return new \Illuminate\Support\HtmlString(
                                    '<div style="display:flex;flex-direction:column;gap:8px;">'
                                    .'<span style="font-size:36px;font-weight:800;letter-spacing:-0.03em;color:'.$color.'">'.$prefix.' $ '.number_format(abs($saldo), 2).'</span>'
                                    .'<span style="font-size:13px;color:#86868b">'.$record->movimientos->count().' movimiento(s)</span>'
                                    .'</div>'
                                );
                            })
                            ->columnSpanFull(),
                    ])
                    ->hidden(fn (?Expediente $record) => $record === null)
                    ->collapsible()
                    ->collapsed(false)
                    ->columnSpanFull(),
                Forms\Components\Select::make('clientes')
                    ->label('Clientes')
                    ->relationship('clientes', 'name', function ($query) {
                        $query->where('tipo_usuario', TipoUsuarioEnum::Cliente);
                    })
                    ->multiple()
                    ->required()
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->placeholder('Selecciona uno o más clientes'),
                Forms\Components\TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->nullable()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->label('Portada (WebP)')
                    ->image()
                    ->acceptedFileTypes(['image/webp'])
                    ->disk('public')
                    ->directory('expedientes')
                    ->previewable()
                    ->imagePreviewHeight('200')
                    ->columnSpanFull(),
                TiptapEditor::make('contenido')
                    ->label('Contenido')
                    ->profile('default')
                    ->columnSpanFull(),
                Forms\Components\Section::make('Opción de Pago')
                    ->description('Cobro simplificado mediante un enlace externo (Stripe, PayPal, Mercado Pago, etc.).')
                    ->schema([
                        Forms\Components\TextInput::make('titulo_opcion_pago')
                            ->label('Título del pago')
                            ->placeholder('Ej. Pago de anticipo')
                            ->nullable()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('descripcion_opcion_pago')
                            ->label('Descripción del pago')
                            ->placeholder('Ej. Anticipo del 50% para inicio del proyecto.')
                            ->nullable()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('cantidad_opcion_pago')
                            ->label('Cantidad')
                            ->numeric()
                            ->inputMode('decimal')
                            ->step(0.01)
                            ->minValue(0.01)
                            ->nullable(),
                        Forms\Components\TextInput::make('enlace_opcion_pago')
                            ->label('Enlace de pago')
                            ->url()
                            ->nullable()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Portada')
                    ->disk('public')
                    ->square()
                    ->size(50),
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('clientes.name')
                    ->label('Clientes')
                    ->badge()
                    ->color('info')
                    ->limitList(3),
                Tables\Columns\TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(80)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('saldo')
                    ->label('Saldo')
                    ->getStateUsing(fn (Expediente $record): string => number_format($record->saldo, 2))
                    ->color(function (Expediente $record): string {
                        return $record->saldo > 0 ? 'success' : ($record->saldo < 0 ? 'danger' : 'gray');
                    })
                    ->formatStateUsing(fn ($state): string => '$ '.$state)
                    ->sortable(false),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MovimientosRelationManager::class,
            RelationManagers\DocumentosRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpedientes::route('/'),
            'create' => Pages\CreateExpediente::route('/create'),
            'edit' => Pages\EditExpediente::route('/{record}/edit'),
        ];
    }
}
