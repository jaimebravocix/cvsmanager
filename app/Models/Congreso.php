<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congreso extends Model
{
    use HasFactory;

    protected $table = 'congresos';

    protected $fillable = [
        'persona_id', 'nombre', 'tipo', 'ambito', 'fecha_inicio', 'fecha_fin', 'ciudad', 'pais', 'institucion_organizadora', 'numero_horas', 'tematica', 'rol_participacion', 'titulo_ponencia', 'numero_certificado', 'archivo_certificado', 'observaciones',
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
