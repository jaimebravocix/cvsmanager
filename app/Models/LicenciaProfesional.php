<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenciaProfesional extends Model
{
    use HasFactory;

    protected $table = 'licencias_profesionales';

    protected $fillable = [
        'persona_id', 'nombre_licencia', 'tipo', 'institucion_emisora', 'numero_licencia', 'especialidad', 'fecha_emision', 'fecha_vencimiento', 'vigente', 'pais', 'archivo', 'observaciones',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
        'vigente' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
