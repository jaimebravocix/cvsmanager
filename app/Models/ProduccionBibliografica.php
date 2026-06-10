<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduccionBibliografica extends Model
{
    use HasFactory;

    protected $table = 'produccion_bibliografica';

    protected $fillable = [
        'persona_id', 'tipo', 'titulo', 'autores', 'editorial', 'lugar_edicion', 'anio_publicacion', 'isbn', 'numero_edicion', 'numero_paginas', 'enlace_url', 'archivo', 'descripcion',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
