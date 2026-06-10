<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    protected $table = 'antecedentes';

    protected $fillable = [
        'persona_id', 'tipo', 'resultado', 'entidad', 'fecha_emision', 'fecha_vencimiento', 'numero_certificado', 'archivo', 'detalle',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
