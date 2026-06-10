<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\LicenciaProfesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenciaProfesionalController extends Controller
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
        return view('licencias.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nombre_licencia' => 'required|string|max:300',
            'tipo' => 'required|string',
            'institucion_emisora' => 'required|string|max:300',
            'numero_licencia' => 'nullable|string|max:100',
            'especialidad' => 'nullable|string|max:200',
            'fecha_emision' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'vigente' => 'boolean',
            'pais' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        LicenciaProfesional::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Licencia Profesional registrado exitosamente.');
    }

    public function edit(Persona $persona, LicenciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        return view('licencias.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, LicenciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nombre_licencia' => 'required|string|max:300',
            'tipo' => 'required|string',
            'institucion_emisora' => 'required|string|max:300',
            'numero_licencia' => 'nullable|string|max:100',
            'especialidad' => 'nullable|string|max:200',
            'fecha_emision' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'vigente' => 'boolean',
            'pais' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Licencia Profesional actualizado correctamente.');
    }

    public function destroy(Persona $persona, LicenciaProfesional $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Licencia Profesional eliminado.');
    }
}
