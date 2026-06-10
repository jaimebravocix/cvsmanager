<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'persona_id', 'tipo', 'direccion', 'urbanizacion', 'distrito', 'provincia', 'departamento', 'pais', 'codigo_postal', 'referencia', 'principal',
    ];

    protected $casts = [
        'principal' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
