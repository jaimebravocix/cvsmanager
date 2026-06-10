<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
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
        return view('direcciones.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'direccion' => 'required|string',
            'urbanizacion' => 'nullable|string|max:150',
            'distrito' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'codigo_postal' => 'nullable|string|max:20',
            'referencia' => 'nullable|string',
            'principal' => 'boolean',
        ]);
        $validated['persona_id'] = $persona->id;
        Direccion::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Dirección registrado exitosamente.');
    }

    public function edit(Persona $persona, Direccion $registro)
    {
        $this->getPersona($persona->id);
        return view('direcciones.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, Direccion $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'direccion' => 'required|string',
            'urbanizacion' => 'nullable|string|max:150',
            'distrito' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'codigo_postal' => 'nullable|string|max:20',
            'referencia' => 'nullable|string',
            'principal' => 'boolean',
        ]);
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Dirección actualizado correctamente.');
    }

    public function destroy(Persona $persona, Direccion $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Dirección eliminado.');
    }
}
