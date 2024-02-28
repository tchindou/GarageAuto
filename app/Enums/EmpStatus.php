<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EmpStatus: string implements HasColor, HasIcon, HasLabel
{
        case NOUVEAU = 'nouveau';

        case EX = 'ex';

        case MUTE = 'mute';

        public function getLabel(): string
        {
                return match ($this) {
                        self::NOUVEAU => 'Nouveau',
                        self::EX => 'Ex',
                        self::MUTE => 'Muté',
                };
        }

        public function getColor(): string | array | null
        {
                return match ($this) {
                        self::NOUVEAU => 'success',
                        self::EX => 'danger',
                        self::MUTE => 'warning',
                };
        }

        public function getIcon(): ?string
        {
                return match ($this) {
                        self::NOUVEAU => 'heroicon-m-sparkles',
                        self::MUTE => 'heroicon-m-arrow-path',
                        self::EX => 'heroicon-m-x-circle',
                };
        }
}
