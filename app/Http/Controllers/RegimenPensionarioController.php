<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\RegimenPensionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegimenPensionarioController extends Controller
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
        return view('regimen.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'nombre_afp' => 'nullable|string|max:100',
            'numero_cuspp' => 'nullable|string|max:50',
            'fecha_afiliacion' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        RegimenPensionario::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Régimen Pensionario registrado exitosamente.');
    }

    public function edit(Persona $persona, RegimenPensionario $registro)
    {
        $this->getPersona($persona->id);
        return view('regimen.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, RegimenPensionario $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'nombre_afp' => 'nullable|string|max:100',
            'numero_cuspp' => 'nullable|string|max:50',
            'fecha_afiliacion' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Régimen Pensionario actualizado correctamente.');
    }

    public function destroy(Persona $persona, RegimenPensionario $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Régimen Pensionario eliminado.');
    }
}
