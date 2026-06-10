<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduccionInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'produccion_investigacion';

    protected $fillable = [
        'persona_id', 'titulo', 'rol', 'codigo_proyecto', 'entidad_financiadora', 'ambito', 'monto_financiado', 'moneda', 'fecha_inicio', 'fecha_fin', 'estado', 'resolucion_aprobacion', 'descripcion', 'archivo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
