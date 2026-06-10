<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\ExperienciaProfesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienciaProfesionalController extends Controller
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
        return view('exprofesional.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'cargo' => 'required|string|max:200',
            'area' => 'nullable|string|max:200',
            'tipo' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'trabajo_actual' => 'boolean',
            'descripcion_funciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        ExperienciaProfesional::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Profesional registrado exitosamente.');
    }

    public function edit(Persona $persona, ExperienciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        return view('exprofesional.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, ExperienciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'cargo' => 'required|string|max:200',
            'area' => 'nullable|string|max:200',
            'tipo' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'trabajo_actual' => 'boolean',
            'descripcion_funciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Profesional actualizado correctamente.');
    }

    public function destroy(Persona $persona, ExperienciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Experiencia Profesional eliminado.');
    }
}
