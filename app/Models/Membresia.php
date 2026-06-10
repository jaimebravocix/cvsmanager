<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $table = 'membresias';

    protected $fillable = [
        'persona_id', 'institucion', 'siglas', 'ambito', 'tipo_membresia', 'numero_membresia', 'fecha_inicio', 'fecha_fin', 'vigente', 'rol_cargo', 'archivo', 'descripcion',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'vigente' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
