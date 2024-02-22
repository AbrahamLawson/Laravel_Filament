<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Renvoyez Stat, les instances de la getStats()méthode
            Stat::make('Amet', Patient::query()->where('type', 'amet')->count()),
            Stat::make('Facere', Patient::query()->where('type', 'facere')->count()),
            Stat::make('Corrupti', Patient::query()->where('type', 'corrupti')->count()),
        ];
    }
}
