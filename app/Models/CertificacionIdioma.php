<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificacionIdioma extends Model
{
    use HasFactory;

    protected $table = 'certificaciones_idioma';

    protected $fillable = [
        'persona_id', 'idioma', 'nivel_comprension', 'nivel_escritura', 'nivel_habla', 'examen_certificacion', 'puntaje', 'institucion', 'fecha', 'fecha_vencimiento', 'archivo', 'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
