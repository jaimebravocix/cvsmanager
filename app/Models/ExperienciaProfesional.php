<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaProfesional extends Model
{
    use HasFactory;

    protected $table = 'experiencia_profesional';

    protected $fillable = [
        'persona_id', 'institucion', 'pais', 'cargo', 'area', 'tipo', 'fecha_inicio', 'fecha_fin', 'trabajo_actual', 'descripcion_funciones', 'archivo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'trabajo_actual' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
