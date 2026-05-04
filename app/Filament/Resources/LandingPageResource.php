<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Filament\Resources\LandingPageResource\RelationManagers;
use App\Models\LandingPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Landing Pages';
    protected static ?string $modelLabel = 'Landing Page';
    protected static ?string $pluralModelLabel = 'Landing Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('view_file')
                    ->label('Template File')
                    ->required()
                    ->options(function () {
                        $path = resource_path('views/landing-pages');
                        if (!\Illuminate\Support\Facades\File::exists($path)) {
                            return [];
                        }
                        return collect(\Illuminate\Support\Facades\File::files($path))
                            ->filter(fn($file) => str_ends_with($file->getFilename(), '.blade.php'))
                            ->mapWithKeys(function ($file) {
                                $name = str_replace('.blade.php', '', $file->getFilename());
                                return ["landing-pages.{$name}" => $name];
                            })->toArray();
                    }),
                Forms\Components\TextInput::make('meta_title'),
                Forms\Components\Textarea::make('meta_description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('seo_image')
                    ->label('SEO Cover Image (Meta Portada)')
                    ->image()
                    ->directory('seo-images')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_default_root')
                    ->required(),
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
                    Tables\Columns\TextColumn::make('slug')
                        ->color('gray')
                        ->icon('heroicon-m-link')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('meta_description')
                        ->color('gray')
                        ->limit(150)
                        ->wrap()
                        ->searchable(),
                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('view_file')
                            ->badge()
                            ->color('info')
                            ->searchable(),
                        Tables\Columns\IconColumn::make('is_default_root')
                            ->boolean()
                            ->label('Principal')
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
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }
}
