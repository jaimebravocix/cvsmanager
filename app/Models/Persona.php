<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'user_id', 'apellido_paterno', 'apellido_materno', 'nombres',
        'sexo', 'fecha_nacimiento', 'lugar_nacimiento', 'pais_nacimiento',
        'estado_civil', 'telefono', 'celular', 'tipo_personal',
        'codigo_personal', 'foto', 'resumen_profesional', 'activo',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido_paterno} {$this->apellido_materno}, {$this->nombres}";
    }

    public function user()            { return $this->belongsTo(User::class); }
    public function documentos()      { return $this->hasMany(DocumentoIdentidad::class); }
    public function direcciones()     { return $this->hasMany(Direccion::class); }
    public function emails()          { return $this->hasMany(EmailPersona::class); }
    public function regimenesP()      { return $this->hasMany(RegimenPensionario::class); }
    public function cuentasHaberes()  { return $this->hasMany(CuentaHaberes::class); }
    public function documentosSalud() { return $this->hasMany(DocumentoSalud::class); }
    public function antecedentes()    { return $this->hasMany(Antecedente::class); }
    public function formacionAcademica() { return $this->hasMany(FormacionAcademica::class); }
    public function experienciaDocente() { return $this->hasMany(ExperienciaDocente::class); }
    public function experienciaProfesional() { return $this->hasMany(ExperienciaProfesional::class); }
    public function certificacionesIdioma() { return $this->hasMany(CertificacionIdioma::class); }
    public function registrosInstitucionales() { return $this->hasMany(RegistroInstitucional::class); }
    public function produccionCientifica() { return $this->hasMany(ProduccionCientifica::class); }
    public function produccionBibliografica() { return $this->hasMany(ProduccionBibliografica::class); }
    public function produccionInvestigacion() { return $this->hasMany(ProduccionInvestigacion::class); }
    public function congresos()       { return $this->hasMany(Congreso::class); }
    public function reconocimientos() { return $this->hasMany(Reconocimiento::class); }
    public function licencias()       { return $this->hasMany(LicenciaProfesional::class); }
    public function membresias()      { return $this->hasMany(Membresia::class); }
}
