<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Filament\Resources\LandingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandingPage extends EditRecord
{
    protected static string $resource = LandingPageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->record;
        if ($record) {
            $data['projects'] = $record->projects()
                ->orderBy('landing_page_project.sort_order')
                ->get()
                ->map(fn ($p) => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'technologies' => collect($p->technologies ?? [])->map(function ($t) {
                        while (is_array($t) && isset($t['value'])) {
                            $t = $t['value'];
                        }
                        return is_array($t) ? json_encode($t) : (string) $t;
                    })->implode(', '),
                ])
                ->toArray();

            $data['services'] = $record->services()
                ->orderBy('landing_page_service.sort_order')
                ->get()
                ->map(fn ($s) => ['id' => $s->id])
                ->toArray();
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $projects = $data['projects'] ?? [];
        unset($data['projects']);

        $syncData = [];
        foreach ($projects as $index => $project) {
            $syncData[$project['id']] = [
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->record->projects()->sync($syncData);

        $services = $data['services'] ?? [];
        unset($data['services']);

        $serviceSyncData = [];
        foreach ($services as $index => $service) {
            $serviceSyncData[$service['id']] = [
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->record->services()->sync($serviceSyncData);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
