<?php

namespace App\Enums;

enum TipoUsuarioEnum: string
{
    case Administrador = 'Administrador';
    case Cliente = 'Cliente';

    public function label(): string
    {
        return $this->value;
    }

    public function color(): string
    {
        return match ($this) {
            self::Administrador => 'danger',
            self::Cliente => 'success',
        };
    }
}
