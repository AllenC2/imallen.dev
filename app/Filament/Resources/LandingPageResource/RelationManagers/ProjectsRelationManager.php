<?php

namespace App\Filament\Resources\LandingPageResource\RelationManagers;

use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->label('Proyecto')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Orden')
                    ->required()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(100)
                    ->wrap(),
                Tables\Columns\TextColumn::make('technologies')
                    ->label('Tecnologías')
                    ->formatStateUsing(function ($state) {
                        if (!is_array($state)) {
                            return $state;
                        }
                        return collect($state)->implode(', ');
                    })
                    ->limit(80),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(query: fn ($query, $direction) => $query->orderBy('landing_page_project.sort_order', $direction)),
            ])
            ->defaultSort('landing_page_project.sort_order')
            ->modifyQueryUsing(fn ($query) => $query->orderBy('landing_page_project.sort_order'))
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
