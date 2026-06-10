<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\ExperienciaDocente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienciaDocenteController extends Controller
{
    private function getPersona(int $personaId): Persona
    {
        $persona = Persona::findOrFail($personaId);
        $user = Auth::user();
        if (!$user->hasRole(['administrador', 'supervisor']) && $persona->user_id !== $user->id) {
            abort(403, 'Sin acceso a este perfil.');
        }
        return $persona;
    }

    public function create(Persona $persona)
    {
        $this->getPersona($persona->id);
        return view('experiencia.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'facultad' => 'nullable|string|max:200',
            'departamento' => 'nullable|string|max:200',
            'curso_asignatura' => 'nullable|string|max:300',
            'categoria' => 'nullable|string',
            'condicion' => 'nullable|string',
            'regimen' => 'nullable|string',
            'nivel_educativo' => 'nullable|string|max:100',
            'horas_semanales' => 'nullable|integer|min:1|max:80',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'trabajo_actual' => 'boolean',
            'resolucion' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        ExperienciaDocente::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Docente registrado exitosamente.');
    }

    public function edit(Persona $persona, ExperienciaDocente $registro)
    {
        $this->getPersona($persona->id);
        return view('experiencia.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, ExperienciaDocente $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'facultad' => 'nullable|string|max:200',
            'departamento' => 'nullable|string|max:200',
            'curso_asignatura' => 'nullable|string|max:300',
            'categoria' => 'nullable|string',
            'condicion' => 'nullable|string',
            'regimen' => 'nullable|string',
            'nivel_educativo' => 'nullable|string|max:100',
            'horas_semanales' => 'nullable|integer|min:1|max:80',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'trabajo_actual' => 'boolean',
            'resolucion' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Docente actualizado correctamente.');
    }

    public function destroy(Persona $persona, ExperienciaDocente $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Docente eliminado.');
    }
}
