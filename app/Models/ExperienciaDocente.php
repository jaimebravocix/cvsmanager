<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienciaDocente extends Model
{
    use HasFactory;

    protected $table = 'experiencia_docente';

    protected $fillable = [
        'persona_id', 'institucion', 'pais', 'facultad', 'departamento', 'curso_asignatura', 'categoria', 'condicion', 'regimen', 'nivel_educativo', 'horas_semanales', 'fecha_inicio', 'fecha_fin', 'trabajo_actual', 'resolucion', 'archivo', 'descripcion',
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
