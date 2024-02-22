<?php

namespace App\Filament\Gerant\Widgets;

use App\Filament\Resources\RdvResource\Pages\ListRdvs;
use App\Filament\Resources\EmployeResource\Pages\ListEmployes;
use App\Filament\Resources\InterventionResource\Pages\ListInterventions;
use App\Models\Rdv;
use App\Models\Employe;
use App\Models\Intervention;
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
                $user = auth()->user();

                $rdvCount = Rdv::count();
                $rdvChange = $rdvCount - Rdv::where('created_at', '<', now()->subMonth())->count();
                $rdvIcon = $rdvChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $rdvColor = $rdvChange >= 0 ? 'success' : 'danger';
                $rdvType = $rdvChange >= 0 ? 'hausse' : 'baisse';

                $employeCount = Employe::count();
                $employeChange = $employeCount - Employe::where('created_at', '<', now()->subMonth())->count();
                $employeIcon = $employeChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $employeColor = $employeChange >= 0 ? 'success' : 'danger';
                $employeType = $employeChange >= 0 ? 'hausse' : 'baisse';

                $interventionCount = Intervention::count();
                $interventionChange = $interventionCount - Intervention::where('created_at', '<', now()->subMonth())->count();
                $interventionIcon = $interventionChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
                $interventionColor = $interventionChange >= 0 ? 'success' : 'danger';
                $interventionType = $interventionChange >= 0 ? 'hausse' : 'baisse';

                return [
                        Stat::make('Rendez-vous', $rdvCount)
                                ->descriptionIcon($rdvIcon)
                                ->description($rdvType . ' ' . $rdvChange . ' Rendez-vous')
                                ->color($rdvColor),
                        Stat::make('Employés', $employeCount)
                                ->descriptionIcon($employeIcon)
                                ->description($employeType . ' ' . $employeChange . ' Employés')
                                ->color($employeColor),
                        Stat::make('Interventions', $interventionCount)
                                ->descriptionIcon($interventionIcon)
                                ->description($interventionType . ' ' . $interventionChange . ' Interventions')
                                ->color($interventionColor),
                ];
        }
}
