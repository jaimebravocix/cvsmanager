<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\CuentaHaberes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaHaberesController extends Controller
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
        return view('haberes.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'banco' => 'required|string|max:100',
            'numero_cuenta' => 'required|string|max:30',
            'tipo_cuenta' => 'required|string',
            'cci' => 'nullable|string|max:30',
            'moneda' => 'required|string',
            'principal' => 'boolean',
            'observaciones' => 'nullable|string',
        ]);
        $validated['persona_id'] = $persona->id;
        CuentaHaberes::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Cuenta de Haberes registrado exitosamente.');
    }

    public function edit(Persona $persona, CuentaHaberes $registro)
    {
        $this->getPersona($persona->id);
        return view('haberes.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, CuentaHaberes $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'banco' => 'required|string|max:100',
            'numero_cuenta' => 'required|string|max:30',
            'tipo_cuenta' => 'required|string',
            'cci' => 'nullable|string|max:30',
            'moneda' => 'required|string',
            'principal' => 'boolean',
            'observaciones' => 'nullable|string',
        ]);
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Cuenta de Haberes actualizado correctamente.');
    }

    public function destroy(Persona $persona, CuentaHaberes $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Cuenta de Haberes eliminado.');
    }
}
