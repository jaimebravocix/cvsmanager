<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailPersona extends Model
{
    use HasFactory;

    protected $table = 'emails_persona';

    protected $fillable = [
        'persona_id', 'tipo', 'email', 'principal',
    ];

    protected $casts = [
        'principal' => 'boolean',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
