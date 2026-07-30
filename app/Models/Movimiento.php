<?php

namespace App\Models;

use App\Enums\TipoMovimientoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    /** @use HasFactory<\Database\Factories\MovimientoFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'expediente_id',
        'tipo',
        'monto',
        'descripcion',
        'fecha',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tipo' => TipoMovimientoEnum::class,
            'monto' => 'decimal:2',
            'fecha' => 'date',
        ];
    }

    public function expediente(): BelongsTo
    {
        return $this->belongsTo(Expediente::class);
    }
}
