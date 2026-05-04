<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\LandingPage;

class LandingPageVisitsChart extends ChartWidget
{
    protected static ?int $sort = -1;

    protected static ?string $heading = 'Visitas por Landing Page (Top 5)';

    protected function getData(): array
    {
        $landingPages = LandingPage::orderBy('visits', 'desc')->take(5)->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visitas',
                    'data' => $landingPages->pluck('visits')->toArray(),
                ],
            ],
            'labels' => $landingPages->pluck('slug')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
