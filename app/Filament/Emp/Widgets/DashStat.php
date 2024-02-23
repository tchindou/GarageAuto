<?php

namespace App\Filament\Emp\Widgets;

use App\Filament\Resources\RdvResource\Pages\ListRdvs;
use App\Filament\Resources\EmployeResource\Pages\ListEmployes;
use App\Filament\Resources\InterventionResource\Pages\ListInterventions;
use App\Models\Rdv;
use App\Models\Employe;
use App\Models\Intervention;
use App\Models\Tache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashStat extends BaseWidget
{
        use InteractsWithPageTable;

        protected static ?string $pollingInterval = null;

        protected function getRdvTablePage(): string
        {
                return ListRdvs::class;
        }

        protected function getEmployeTablePage(): string
        {
                return ListEmployes::class;
        }

        protected function getInterventionTablePage(): string
        {
                return ListInterventions::class;
        }

        protected function getStats(): array
        {
                // Obtenez l'ID de l'employé authentifié
                $employeId = auth()->user()->user_id;

                // Utilisez l'ID de l'employé pour trouver le garage correspondant
                $employe = Employe::find($employeId);

                // Obtenez l'ID du garage
                $garageId = $employe->garage_id;

                $rdvCount = Rdv::where('garage_id', $garageId)
                        ->count();
                $rdvChange = $rdvCount - Rdv::where('garage_id', $garageId)->where('created_at', '<', now()->subMonth())->count();
                $rdvIcon = $rdvChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $rdvColor = $rdvChange >= 0 ? 'success' : 'danger';
                $rdvType = $rdvChange >= 0 ? 'hausse' : 'baisse';

                $tacheCount = Tache::where('garage_id', $garageId)
                        ->count();
                $tacheChange = $tacheCount - Tache::where('garage_id', $garageId)->where('created_at', '<', now()->subMonth())->count();
                $tacheIcon = $tacheChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $tacheColor = $tacheChange >= 0 ? 'success' : 'danger';
                $tacheType = $tacheChange >= 0 ? 'hausse' : 'baisse';

                $interventionCount = Intervention::where('garage_id', $garageId)
                        ->count();
                $interventionChange = $interventionCount - Intervention::where('garage_id', $garageId)->where('created_at', '<', now()->subMonth())->count();
                $interventionIcon = $interventionChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $interventionColor = $interventionChange >= 0 ? 'success' : 'danger';
                $interventionType = $interventionChange >= 0 ? 'hausse' : 'baisse';


                return [
                        Stat::make('Rendez-vous', $rdvCount)
                                ->descriptionIcon($rdvIcon)
                                ->description($rdvType . ' ' . $rdvChange . ' Rendez-vous')
                                ->color($rdvColor),
                        Stat::make('Employés', $tacheCount)
                                ->descriptionIcon($tacheIcon)
                                ->description($tacheType . ' ' . $tacheChange . ' Taches')
                                ->color($tacheColor),
                        Stat::make('Interventions', $interventionCount)
                                ->descriptionIcon($interventionIcon)
                                ->description($interventionType . ' ' . $interventionChange . ' Interventions')
                                ->color($interventionColor),
                ];
        }
}
