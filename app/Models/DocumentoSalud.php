<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoSalud extends Model
{
    use HasFactory;

    protected $table = 'documentos_salud';

    protected $fillable = [
        'persona_id', 'tipo', 'descripcion', 'entidad', 'fecha_emision', 'fecha_vencimiento', 'numero_documento', 'archivo', 'observaciones',
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
