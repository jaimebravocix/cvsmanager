<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconocimiento extends Model
{
    use HasFactory;

    protected $table = 'reconocimientos';

    protected $fillable = [
        'persona_id', 'tipo', 'descripcion', 'institucion_otorgante', 'pais', 'fecha', 'resolucion', 'archivo', 'detalle',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
