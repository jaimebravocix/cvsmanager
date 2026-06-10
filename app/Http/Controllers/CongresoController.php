<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Congreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CongresoController extends Controller
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
        return view('congresos.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:400',
            'tipo' => 'required|string',
            'ambito' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'institucion_organizadora' => 'nullable|string|max:300',
            'numero_horas' => 'nullable|integer|min:1',
            'tematica' => 'nullable|string',
            'rol_participacion' => 'required|string',
            'titulo_ponencia' => 'nullable|string|max:400',
            'numero_certificado' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo_certificado' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo_certificado')) {
            $validated['archivo_certificado'] = $request->file('archivo_certificado')->store('documentos', 'public');
        }
        Congreso::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Congreso / Evento registrado exitosamente.');
    }

    public function edit(Persona $persona, Congreso $registro)
    {
        $this->getPersona($persona->id);
        return view('congresos.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, Congreso $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:400',
            'tipo' => 'required|string',
            'ambito' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'ciudad' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'institucion_organizadora' => 'nullable|string|max:300',
            'numero_horas' => 'nullable|integer|min:1',
            'tematica' => 'nullable|string',
            'rol_participacion' => 'required|string',
            'titulo_ponencia' => 'nullable|string|max:400',
            'numero_certificado' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo_certificado' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo_certificado')) {
            $validated['archivo_certificado'] = $request->file('archivo_certificado')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Congreso / Evento actualizado correctamente.');
    }

    public function destroy(Persona $persona, Congreso $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Congreso / Evento eliminado.');
    }
}
