<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (is_array($data['technologies'] ?? null)) {
            $data['technologies'] = array_map(fn ($v) => is_array($v) ? ($v['value'] ?? '') : $v, $data['technologies']);
            $data['technologies'] = array_map(fn ($v) => ['value' => $v], $data['technologies']);
        }
        if (is_array($data['images'] ?? null)) {
            $data['images'] = array_map(fn ($v) => is_array($v) ? ($v['value'] ?? $v) : $v, $data['images']);
            $data['images'] = array_values(array_filter($data['images']));
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
