<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $clientes
 */
class Expediente extends Model
{
    /** @use HasFactory<\Database\Factories\ExpedienteFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'cover_image',
        'contenido',
        'titulo_opcion_pago',
        'descripcion_opcion_pago',
        'cantidad_opcion_pago',
        'enlace_opcion_pago',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cantidad_opcion_pago' => 'decimal:2',
        ];
    }

    public function clientes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'expediente_user')
            ->withTimestamps();
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(DocumentoPdf::class);
    }

    public function getSaldoAttribute(): float
    {
        return $this->movimientos
            ->sum(fn (Movimiento $m) => $m->tipo->sign() * (float) $m->monto);
    }
}
