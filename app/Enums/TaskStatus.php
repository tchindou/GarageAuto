<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TaskStatus: string implements HasColor, HasIcon, HasLabel
{
        case ENCOURS = 'en cours';

        case FINI = 'fini';

        case ANNULE = 'annulé';

        public function getLabel(): string
        {
                return match ($this) {
                        self::ENCOURS => 'En cours',
                        self::FINI => 'Terminé',
                        self::ANNULE => 'Annulé',
                };
        }

        public function getColor(): string | array | null
        {
                return match ($this) {
                        self::ENCOURS => 'success',
                        self::FINI => 'danger',
                        self::ANNULE => 'warning',
                };
        }

        public function getIcon(): ?string
        {
                return match ($this) {
                        self::ENCOURS => 'heroicon-m-sparkles',
                        self::ANNULE => 'heroicon-m-arrow-path',
                        self::FINI => 'heroicon-m-x-circle',
                };
        }
}
