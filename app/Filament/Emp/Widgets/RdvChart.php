<?php

namespace App\Filament\Emp\Widgets;

use App\Models\Tache;
use App\Models\Employe;
use App\Models\Rdv;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class RdvChart extends ChartWidget
{
    protected static ?string $heading = 'Pourcentage des catégories de rendez-vous';

    protected static ?string $maxHeight = '300px';

    protected static ?string $pollingInterval = '5s';

    protected function getData(): array
    {
        // Obtenez l'ID de l'employé authentifié
        $employeId = auth()->user()->user_id;

        // Utilisez l'ID de l'employé pour trouver le garage correspondant
        $employe = Employe::find($employeId);

        // Obtenez l'ID du garage
        $garageId = $employe->garage_id;

        $totalTaches = Tache::where('garage_id', $garageId)
            ->count();
        $totalRdvs = Rdv::where('garage_id', $garageId)
            ->count();

        $tachesStats = Tache::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->all();

        $rdvsStats = Rdv::select('valide', DB::raw('count(*) as total'))
            ->where('garage_id', $garageId)
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
            'labels' => array_keys($rdvsData),
            'datasets' => [
                [
                    'label' => 'Stat Rdvs',
                    'data' => array_values($rdvsData),
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
