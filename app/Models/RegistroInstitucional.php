<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroInstitucional extends Model
{
    use HasFactory;

    protected $table = 'registros_institucionales';

    protected $fillable = [
        'persona_id', 'institucion', 'tipo_registro', 'numero_registro', 'fecha_registro', 'fecha_vencimiento', 'categoria', 'especialidad', 'vigente', 'archivo', 'observaciones',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'fecha_vencimiento' => 'date',
        'vigente' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
