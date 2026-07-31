<?php

namespace App\Filament\Resources\ExpedienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentosRelationManager extends RelationManager
{
    protected static string $relationship = 'documentos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('ruta')
                    ->label('Archivo PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('documentos')
                    ->preserveFilenames()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Hidden::make('added_by')
                    ->default(fn () => Auth::id()),
                Forms\Components\Hidden::make('nombre_original'),
                Forms\Components\Hidden::make('tamanio_bytes'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre_original')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nombre_original')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),
                Tables\Columns\TextColumn::make('tamanio_bytes')
                    ->label('Tamaño')
                    ->formatStateUsing(fn ($state): string => $this->formatBytes($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('addedBy.name')
                    ->label('Subido por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        if (! empty($data['ruta'])) {
                            $path = $data['ruta'];
                            $disk = Storage::disk('public');

                            $data['nombre_original'] = pathinfo($path, PATHINFO_BASENAME);
                            $data['tamanio_bytes'] = $disk->exists($path) ? $disk->size($path) : 0;
                            $data['added_by'] = Auth::id();
                        }

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Descargar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record): string => Storage::disk('public')->url($record->ruta))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        Storage::disk('public')->delete($record->ruta);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function formatBytes(?int $bytes): string
    {
        if ($bytes === null || $bytes === 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        $value = $bytes;

        while ($value >= 1024 && $i < count($units) - 1) {
            $value /= 1024;
            $i++;
        }

        return round($value, $i === 0 ? 0 : 1).' '.$units[$i];
    }
}
