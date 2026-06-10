<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoIdentidad extends Model
{
    use HasFactory;

    protected $table = 'documentos_identidad';

    protected $fillable = [
        'persona_id', 'tipo', 'numero', 'pais_emision', 'fecha_emision', 'fecha_vencimiento', 'archivo', 'principal', 'observaciones',
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date',
        'principal' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
