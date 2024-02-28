<?php

namespace App\Filament\Gerant\Widgets;

use App\Models\Tache;
use App\Models\Rdv;
use App\Models\Garage;
use App\Models\Employe;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class TaskChart extends ChartWidget
{
    protected static ?string $heading = 'Pourcentage des catégories de tâches';

    protected static ?string $maxHeight = '300px';

    protected static ?string $pollingInterval = '5s';

    protected function getData(): array
    {
        // Obtenez l'ID du gérant authentifié
        $gerantId = auth()->user()->user_id;

        // Utilisez l'ID du gérant pour trouver le garage correspondant
        $garages = Garage::where('gerant_id', $gerantId)->get();

        // Obtenez l'ID du garage
        $garageId = $garages->pluck('id')->toArray();

        $totalTaches = Tache::whereIn('garage_id', $garageId)
            ->count();
        $totalRdvs = Rdv::whereIn('garage_id', $garageId)
            ->count();

        $tachesStats = Tache::select('status', DB::raw('count(*) as total'))
            ->whereIn('garage_id', $garageId)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        $rdvsStats = Rdv::select('valide', DB::raw('count(*) as total'))
            ->whereIn('garage_id', $garageId)
            ->groupBy('valide')
            ->pluck('total', 'valide')
            ->all();

        $tachesData = [
            'encours' => isset($tachesStats['encours']) && $totalTaches != 0 ? $tachesStats['encours'] / $totalTaches * 100 : 0,
            'fini' => isset($tachesStats['fini']) && $totalTaches != 0 ? $tachesStats['fini'] / $totalTaches * 100 : 0,
            'annule' => isset($tachesStats['annule']) && $totalTaches != 0 ? $tachesStats['annule'] / $totalTaches * 100 : 0,
        ];

        $rdvsData = [
            'valide' => isset($rdvsStats[1]) && $totalRdvs != 0 ? $rdvsStats[1] / $totalRdvs * 100 : 0,
            'non_valide' => isset($rdvsStats[0]) && $totalRdvs != 0 ? $rdvsStats[0] / $totalRdvs * 100 : 0,
        ];

        return [
            'labels' => array_keys($tachesData),
            'datasets' => [
                [
                    'label' => 'Stat Employes',
                    'data' => array_values($tachesData),
                    'borderColor' => 'yellow',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
