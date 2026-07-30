<?php

namespace App\Models;

use App\Enums\TipoUsuarioEnum;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tipo_usuario' => TipoUsuarioEnum::class,
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->tipo_usuario === TipoUsuarioEnum::Administrador;
    }

    public function isAdmin(): bool
    {
        return $this->tipo_usuario === TipoUsuarioEnum::Administrador;
    }

    public function isCliente(): bool
    {
        return $this->tipo_usuario === TipoUsuarioEnum::Cliente;
    }

    public function expedientes(): BelongsToMany
    {
        return $this->belongsToMany(Expediente::class, 'expediente_user')
            ->withTimestamps();
    }
}
