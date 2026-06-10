<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormacionAcademica extends Model
{
    use HasFactory;

    protected $table = 'formacion_academica';

    protected $fillable = [
        'persona_id', 'nivel', 'especialidad', 'mencion', 'institucion', 'pais', 'anio_inicio', 'anio_fin', 'fecha_grado', 'numero_resolucion', 'numero_registro_sunedu', 'es_titulo_habilitante', 'archivo', 'observaciones',
    ];

    protected $casts = [
        'fecha_grado' => 'date',
        'es_titulo_habilitante' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
