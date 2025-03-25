<?php

namespace App\Enums;

enum SlotStatus: string
{
    case Available = 'available';
    case Booked = 'booked';

    public function label(): string
    {
        return match($this) {
            self::Available => 'Available',
            self::Booked => 'Booked',
        };
    }
}
