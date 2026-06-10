<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'tipo_usuario', 'activo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    public function persona()
    {
        return $this->hasOne(Persona::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return $this->persona
            ? $this->persona->apellido_paterno.' '.$this->persona->apellido_materno.', '.$this->persona->nombres
            : $this->name;
    }
}
