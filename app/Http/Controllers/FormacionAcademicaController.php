<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\FormacionAcademica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormacionAcademicaController extends Controller
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
        return view('formacion.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nivel' => 'required|string',
            'especialidad' => 'required|string|max:300',
            'mencion' => 'nullable|string|max:300',
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'anio_inicio' => 'nullable|integer|min:1950|max:2100',
            'anio_fin' => 'nullable|integer|min:1950|max:2100',
            'fecha_grado' => 'nullable|date',
            'numero_resolucion' => 'nullable|string|max:100',
            'numero_registro_sunedu' => 'nullable|string|max:100',
            'es_titulo_habilitante' => 'boolean',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        FormacionAcademica::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Formación Académica registrado exitosamente.');
    }

    public function edit(Persona $persona, FormacionAcademica $registro)
    {
        $this->getPersona($persona->id);
        return view('formacion.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, FormacionAcademica $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nivel' => 'required|string',
            'especialidad' => 'required|string|max:300',
            'mencion' => 'nullable|string|max:300',
            'institucion' => 'required|string|max:300',
            'pais' => 'nullable|string|max:100',
            'anio_inicio' => 'nullable|integer|min:1950|max:2100',
            'anio_fin' => 'nullable|integer|min:1950|max:2100',
            'fecha_grado' => 'nullable|date',
            'numero_resolucion' => 'nullable|string|max:100',
            'numero_registro_sunedu' => 'nullable|string|max:100',
            'es_titulo_habilitante' => 'boolean',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Formación Académica actualizado correctamente.');
    }

    public function destroy(Persona $persona, FormacionAcademica $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Formación Académica eliminado.');
    }
}
