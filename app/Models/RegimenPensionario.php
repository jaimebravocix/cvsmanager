<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimenPensionario extends Model
{
    use HasFactory;

    protected $table = 'regimen_pensionario';

    protected $fillable = [
        'persona_id', 'tipo', 'nombre_afp', 'numero_cuspp', 'fecha_afiliacion', 'archivo', 'observaciones',
    ];

    protected $casts = [
        'fecha_afiliacion' => 'date',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
