<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\ProduccionInvestigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduccionInvestigacionController extends Controller
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
        return view('investigacion.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'titulo' => 'required|string',
            'rol' => 'required|string',
            'codigo_proyecto' => 'nullable|string|max:100',
            'entidad_financiadora' => 'nullable|string|max:300',
            'ambito' => 'nullable|string',
            'monto_financiado' => 'nullable|numeric|min:0',
            'moneda' => 'nullable|string|max:10',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'estado' => 'required|string',
            'resolucion_aprobacion' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        ProduccionInvestigacion::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Proyecto de Investigación registrado exitosamente.');
    }

    public function edit(Persona $persona, ProduccionInvestigacion $registro)
    {
        $this->getPersona($persona->id);
        return view('investigacion.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, ProduccionInvestigacion $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'titulo' => 'required|string',
            'rol' => 'required|string',
            'codigo_proyecto' => 'nullable|string|max:100',
            'entidad_financiadora' => 'nullable|string|max:300',
            'ambito' => 'nullable|string',
            'monto_financiado' => 'nullable|numeric|min:0',
            'moneda' => 'nullable|string|max:10',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
            'estado' => 'required|string',
            'resolucion_aprobacion' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Proyecto de Investigación actualizado correctamente.');
    }

    public function destroy(Persona $persona, ProduccionInvestigacion $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Proyecto de Investigación eliminado.');
    }
}
