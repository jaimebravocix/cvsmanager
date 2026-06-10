<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaHaberes extends Model
{
    use HasFactory;

    protected $table = 'cuentas_haberes';

    protected $fillable = [
        'persona_id', 'banco', 'numero_cuenta', 'tipo_cuenta', 'cci', 'moneda', 'principal', 'observaciones',
    ];

    protected $casts = [
        'principal' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
