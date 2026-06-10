<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduccionCientifica extends Model
{
    use HasFactory;

    protected $table = 'produccion_cientifica';

    protected $fillable = [
        'persona_id', 'tipo', 'titulo', 'autores', 'revista_editorial', 'volumen', 'numero', 'paginas', 'doi', 'issn_isbn', 'anio_publicacion', 'indexacion', 'cuartil', 'factor_impacto', 'enlace_url', 'archivo', 'observaciones',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
