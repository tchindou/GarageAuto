<?php

namespace App\Filament\Widgets;

use App\Models\Tache;
use App\Models\Employe;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class RsvtChart extends ChartWidget
{
    protected static ?string $heading = 'Pourcentage des catégories de tâches et employés';

    protected static ?string $maxHeight = '300px';

    protected static ?string $pollingInterval = '5s';

    protected function getData(): array
    {
        $totalTaches = Tache::count();
        $totalEmployes = Employe::count();

        $tachesStats = Tache::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        $employesStats = Employe::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        $tachesData = [
            'encours' => isset($tachesStats['encours']) ? $tachesStats['encours'] / $totalTaches * 100 : 0,
            'fini' => isset($tachesStats['fini']) ? $tachesStats['fini'] / $totalTaches * 100 : 0,
            'annule' => isset($tachesStats['annule']) ? $tachesStats['annule'] / $totalTaches * 100 : 0,
        ];

        $employesData = [
            'nouveau' => isset($employesStats['nouveau']) ? $employesStats['nouveau'] / $totalEmployes * 100 : 0,
            'ex' => isset($employesStats['ex']) ? $employesStats['ex'] / $totalEmployes * 100 : 0,
            'mute' => isset($employesStats['mute']) ? $employesStats['mute'] / $totalEmployes * 100 : 0,
        ];

        return [
            'labels' => array_keys($tachesData),
            'datasets' => [
                [
                    'label' => 'Stat Taches',
                    'data' => array_values($tachesData),
                    'borderColor' => 'blue',
                ],
                // [
                //     'label' => 'Stat Employes',
                //     'data' => array_values($employesData),
                //     'borderColor' => 'red',
                // ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
