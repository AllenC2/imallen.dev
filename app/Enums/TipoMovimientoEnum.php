<?php

namespace App\Enums;

enum TipoMovimientoEnum: string
{
    case Pago = 'Pago';
    case Cargo = 'Cargo';

    public function label(): string
    {
        return $this->value;
    }

    public function color(): string
    {
        return match ($this) {
            self::Pago => 'success',
            self::Cargo => 'danger',
        };
    }

    public function sign(): int
    {
        return match ($this) {
            self::Pago => 1,
            self::Cargo => -1,
        };
    }
}
